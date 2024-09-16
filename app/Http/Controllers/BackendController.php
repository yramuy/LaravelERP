<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BackendController extends Controller
{
    public function index()
    {
        return view('backend.pages.dashboard');
    }

    public function loginPage()
    {
        return view('backend.pages.login');
    }

    public function login(LoginRequest $request)
    {
        $input = $request->validated();
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->put('email', $input['email']);

            $admin = Auth::guard('admin')->user();

            if ($admin->role == 1) {
                return redirect()->route('dashboard');
            } else {
                $this->logout();
                return redirect(route('login'))->with('error', 'You are not authorized to access admin panel.');
            }

        } else {
            return redirect(route('login'))->with('error', 'Login details are not valid');
        }
    }

    public function signupPage()
    {
        return view('backend.pages.signup');
    }

    public function signup(Request $request)
    {

        // Define your validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];

        // Create a validator instance and check if the validation fails
        $validator = validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Handle the validation failure
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Proceed with your normal processing if validation passes
            // For example, create a new user
            // $user = User::create([
            //     'name' => $request->input('name'),
            //     'email' => $request->input('email'),
            //     'password' => bcrypt($request->input('password')),
            // ]);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect("verification/".$user->id);
        }
    }

    public function verification($id) {
        $user = User::where('id',$id)->first();

        if(!$user || $user->is_verified == 1) {
            return redirect('dashboard');
        }

        $email = $user->email;
        $this->sendOtp($user); //OTP SEND
        return view('backend.pages.verification', compact('email'));
    }

    public function sendOtp($user) {
        $otp = rand(100000,999999);
        $time = time();

        EmailVerification::updateOrCreate(
            ['email' => $user->email],
            ['email' => $user->email,'otp' => $otp,'created_at' => $time]
        );
        $data['email'] = $user->email;
        $data['title'] = 'Mail Verification';
        $data['body'] = 'Your OTP is:- '.$otp;

        Mail::send('backend.pages.mailVerification',['data'=>$data],function($message) use ($data){
            $message->to($data['email'])->subject($data['title']);
        });
    }

    public function verifiedOtp(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $otpData = EmailVerification::where('otp',$request->otp)->first();
        if(!$otpData){
            return response()->json(['success' => false,'msg'=> 'You entered wrong OTP']);
        }
        else{

            $currentTime = time();
            $time = $otpData->created_at;

            if($currentTime >= $time && $time >= $currentTime - (90+5)){//90 seconds
                User::where('id',$user->id)->update([
                    'is_verified' => 1
                ]);
                return response()->json(['success' => true,'msg'=> 'Mail has been verified, Please login with your registred account']);
            }
            else{
                return response()->json(['success' => false,'msg'=> 'Your OTP has been Expired']);
            }

        }
    }

    public function resendOtp(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $otpData = EmailVerification::where('email',$request->email)->first();

        $currentTime = time();
        $time = $otpData->created_at;

        if($currentTime >= $time && $time >= $currentTime - (90+5)){//90 seconds
            return response()->json(['success' => false,'msg'=> 'Please try after some time']);
        }
        else{

            $this->sendOtp($user);//OTP SEND
            return response()->json(['success' => true,'msg'=> 'OTP has been sent']);
        }

    }

    public function logout() {
        // Flush all session data

        session()->flush();
        Auth::guard('admin')->logout();
        return redirect(route('login'));
    }
}
