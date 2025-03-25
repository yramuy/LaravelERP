<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ReportTo;
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

        return response()->json(['status' => 200, 'employee' => $employee, 'path' => "http://localhost:8081/LaravelERP/public/storage/uploads"]);
    }

    public function employeeDelete($id)
    {
        DB::table('employees')->where('emp_number', $id)->delete();

        return response()->json(['status' => 200, 'message' => "Employee deleted successfully"]);
    }

    public function employeesByID(Request $request)
    {
        $id = $request->empID;
        $employee = Employee::whereNot('emp_number', $id)->get();

        return response()->json(['status' => 200, 'employee' => $employee]);
    }

    public function saveUpdateReportTo(Request $request)
    {
        $reportID = $request->reportID;
        $reportType = $request->reportType;

        $empNumber = $request->empNumber;
        $reportEmpNumber = $request->reportEmpNumber;
        $reportingMethod = $request->reportingMethod;

        if ($reportID != 0) {
            $reportTo = ReportTo::where('id', $reportID)->first();
            $reportTo->emp_sup = $reportType == "Supervisor" ? $reportEmpNumber : $empNumber;
            $reportTo->emp_sub = $reportType == "Subordinate" ? $reportEmpNumber : $empNumber;

            $message = "$reportType updated successfully.";
        } else {
            $reportTo = new ReportTo();
            $reportTo->emp_sup = $reportType == "Supervisor" ? $empNumber : $reportEmpNumber;
            $reportTo->emp_sub = $reportType == "Subordinate" ? $empNumber : $reportEmpNumber;
            $message = "$reportType assigned successfully.";
        }

        $reportTo->status = $reportingMethod;
        $reportTo->save();

        if ($reportTo) {
            return response()->json(['status' => 200, 'message' => $message]);
        } else {
            return response()->json(['status' => 500, 'message' => "Internal error occured"]);
        }
    }

    public function reportingEmployeesByEmpID(Request $request)
    {
        $id = $request->empID;
        $type = $request->type;

        if ($type == 'sup') {
            $repotingEmps = ReportTo::join('employees as e', 'e.emp_number', '=', 'report_tos.emp_sup')->where('emp_sub', $id)->select('report_tos.*', 'e.first_name', 'e.last_name')->get();
        } else {
            $repotingEmps = ReportTo::join('employees as e', 'e.emp_number', '=', 'report_tos.emp_sub')->where('emp_sup', $id)->select('report_tos.*', 'e.first_name', 'e.last_name')->get();
        }

        return response()->json(['status' => 200, 'reportings' => $repotingEmps]);
    }

    public function reportingEmpDelete($reportID)
    {
        try {
            $report = ReportTo::where('id', $reportID)->delete();
            if ($report) {
                return response()->json(['status' => 200, 'message' => 'Deleted successfully']);
            } else {
                return response()->json(['status' => 404, 'message' => 'Delete failed']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 500, 'message' => $th]);
        }
    }
}
