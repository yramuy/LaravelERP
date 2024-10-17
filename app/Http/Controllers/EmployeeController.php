<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function allEmployees()
    {
        $employees = DB::table('employees')->where('is_active', 1)->orderBy('emp_number', 'DESC')->get();

        $response = array(
            'status' => 200,
            "employees" => $employees
        );

        return response()->json($response);
    }

    public function saveUpdateEmployee(Request $request)
    {
        // Check if the file was uploaded
        if ($request->hasFile('profile_pic')) {

            // Get the file
            $file = $request->file('profile_pic');

            // Get the file's original name
            $fileName = $file->getClientOriginalName();

            // Get the file's extension
            $extension = $file->getClientOriginalExtension();

            // Optionally: store the file
            $file->storeAs('uploads', $fileName, 'public');
        } else {

            $id = $request->empID;
            $employee = DB::table('employees')->where('emp_number', $id)->first();
            $fileName = $employee->profile_pic;
        }

        // Store employee data
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'employee_id' => $request->employee_id,
            'dob' => $request->dob,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'position' => $request->position,
            'profile_pic' => $fileName,
            'is_active' => $request->is_active,
        ];

        // Define the conditions to check for an existing record
        $condition = [
            'emp_number' => $request->empID
        ];

        // Perform the update or insert
        DB::table('employees')->updateOrInsert($condition, $data);

        // echo $result;

        // if ($result) {
        $message = $request->empID ? "Employee updated successfully." : "Employee added successfully.";

        return response()->json(['status' => 200, 'message' => $message]);
        // } else {
        //     return response()->json(['status' => 404, 'message' => 'Employee create failed!']);
        // }
    }

    public function employeeDataByEmpID($id)
    {
        $employee = DB::table('employees')->where('emp_number', $id)->first();

        return response()->json(['status' => 200, 'employee' => $employee, 'path' => "http://localhost/LaravelERP/public/storage/uploads"]);
    }

    public function employeeDelete($id)
    {
        DB::table('employees')->where('emp_number', $id)->delete();

        return response()->json(['status' => 200, 'message' => "Employee deleted successfully"]);
    }
}
