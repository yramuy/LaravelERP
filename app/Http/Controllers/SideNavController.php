<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class SideNavController extends Controller
{
    //
    public function aboutPage()
    {
        $profile = About::first();
        $skills = Skill::all();
        return view('backend.pages.about', compact('profile', 'skills'));
    }

    public function saveAbout(Request $request)
    {
        // Validation Rules

        if ($request->profile_id) {
            $fileRules = '';
        } else {
            $fileRules = 'required|file|mimes:jpg,png';
        }

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'profile' => 'required',
            'phone' => 'required',
            'long_text' => 'required',
            'profile_image' => $fileRules
        ];

        // Create a validator instance and check if the validation fails

        $validator = FacadesValidator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Handle the validation failure
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $fileName = time() . '_' . $file->getClientOriginalName();
            }

            if ($request->profile_id) {
                $aboutObj = About::find($request->profile_id);
                if (($aboutObj->id != '' && $request->hasFile('profile_image'))) {
                    $aboutObj->profile_image = $fileName;
                } else {
                    $fileName1 = $aboutObj->profile_image;
                    $aboutObj->profile_image = $fileName1;
                }
            } else {
                $aboutObj = new About();
                $aboutObj->profile_image = $fileName;
            }
            $aboutObj->name = $request->name;
            $aboutObj->email = $request->email;
            $aboutObj->profile = $request->profile;
            $aboutObj->phone = $request->phone;
            $aboutObj->long_text = $request->long_text;

            $aboutObj->save();

            if (($aboutObj->id != '' && $request->hasFile('profile_image'))) {
                $request->file('profile_image')->storeAs('uploads', $fileName, 'public');
            }
            $id = $aboutObj->id;
            $skillData = $request->skill;
            $percentage = $request->percentage;


            if (!empty($skillData)) {
                for ($i = 0; $i < sizeof($skillData); $i++) {
                    if ($request->skill_id[$i]) {
                        $skillObj = Skill::find($request->skill_id[$i]);
                    } else {
                        $skillObj = new Skill();
                    }

                    $skillObj->profile_id = $id;
                    $skillObj->skill_name = $skillData[$i];
                    $skillObj->percentage = $percentage[$i];
                    $skillObj->save();
                }
            }

            return back()->with('success', 'Data saved successfully.');
        }
    }

    public function deleteSkill(Request $request)
    {
        $skill = Skill::find($request->skillId);
        $skill->delete();
        return back()->with('success', 'Skill deleted successfully.');
    }

    public function ServicePage()
    {
        return view('backend.pages.services');
    }

    public function saveService(Request $request)
    {
        $title = $request->title;
        $serviceId = $request->service_id;
        $description = $request->description;

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $fileName = time() . '_' . $icon->getClientOriginalName();
        }

        if (empty($serviceId)) {
            $service = new Service();
            $service->icon_name = $fileName;
        } else {
            $service = Service::find($serviceId);
            if ($request->hasFile('icon')) {
                $service->icon_name = $fileName;
            } else {
                $img = $service->icon_name;
                $service->icon_name = $img;
            }
        }

        $service->title = $title;
        $service->description = $description;

        $service->save();

        if ($request->hasFile('icon')) {
            $request->file('icon')->storeAs('uploads', $fileName, 'public');
        }

        $message = $serviceId ? "Service updated successfully" : "Service saved successfully";

        return response()->json(['success' => $message]);
    }

    public function ServiceList()
    {
        $services = Service::all();

        return response()->json(['services' => $services]);
    }

    public function serviceData(Request $request)
    {
        $id = $request->serviceId;

        $service = Service::find($id);

        return response()->json(['service' => $service]);
    }

    public function deleteService(Request $request)
    {
        $service = Service::find($request->serviceId);
        $service->delete();
        return response()->json(['success' => "Service deleted successfully"]);
    }
}
