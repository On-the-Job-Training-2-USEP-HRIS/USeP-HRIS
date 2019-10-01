<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeInsertController extends Controller
{
    public function addForm (Request $request){
        $formcontent = $request->input();
        $formdataresult = json_decode(json_encode($formcontent),true);
        // dd($formcontent);
        foreach($formdataresult as $key => $datavalue){

            // Employee user generation
            if($key == "1"){
                $username_first = $datavalue[2]; // First half of username generation : Surname
            }
            if($key == "2"){
                $username_last = $datavalue[2]; // Second half of username generation
                $last_empid = \DB::select('call getPDS_employeeID'); // Select the latest employee ID to be added to username : First Name
                $last_empid_result = $last_empid[0] -> maxID;
                $user_comb = strtolower(str_replace(' ', '', $username_first . "." . $username_last)) . "." . ($last_empid_result); // Username combination of first and second half with the latest employee ID
                $default_pass = password_hash("emp@123", PASSWORD_DEFAULT);

                \DB::statement("CALL insert_PDS_user('$user_comb', '$default_pass')");
            // End of Employee user generation

            }
            
            if($key == "employee_type"){
                \DB::statement("CALL insert_employee('$datavalue')"); // Adds new Employee with employee_type
            }
            if($key > 0){
                // echo $datavalue[0] . "<br>"; Group ID
                // echo $datavalue[1] . "<br>"; Fieldsubfied ID
                // echo $datavalue[2] . "<br>"; Data
                if ( ! isset($datavalue[2])) {
                    if ($datavalue[0] == 4){
                        // $datavalue[2] = date('Y-m-d H:i:s'); // Datetime problem if Null
                        $date_default = '00-00-0000 00:00:00'; // 1970-01-01 00:00:00 will be input in the database
                        $datavalue[2] = date ("Y-m-d H:i:s", strtotime($date_default));
                    } else if ($datavalue[0] == 1){
                        $datavalue[2] = "0";    // Digit does not accept Null
                    } else {
                        $datavalue[2] = null;
                    }
                 }

                 // Filtering of data to be inserted into database table according to data group
                 
                \DB::statement("CALL insert_employeedata('$datavalue[1]')");
                switch ($datavalue[0]) {
                    case 1 : \DB::statement("CALL insert_datadigit('$datavalue[2]')"); break;
                    case 2 : \DB::statement("CALL insert_datatext('$datavalue[2]')"); break;
                    case 3 : \DB::statement("CALL insert_datafile('$datavalue[2]')"); break;
                    case 4 : \DB::statement("CALL insert_datadate('$datavalue[2]')"); break;
                }
            }
        }

        $data = \DB::select('call getPDS_Dashboard');
        $result = json_decode(json_encode($data),true);

        $getEmployeeType = \DB::select('call getPDS_employeetype');
        $result1 = json_decode(json_encode($getEmployeeType),true);
        
        return view('Employee/emphome', compact('result', 'result1'));
    }

    public function searchbyUsername (Request $request){
        $formcontent = $request->input();
        $search_input = json_decode(json_encode($formcontent),true);
        // dd($search_input);

        foreach($search_input as $key => $datavalue){
            if($key == "username_input"){
                // $username_first = $datavalue[2]; 
                // dd($datavalue);
                $emp_data = \DB::select("call get_Employee_DatabyUsername('$datavalue')");
                $emp_dataresult = json_decode(json_encode($emp_data),true);
                dd($emp_dataresult);
            }  
        }

        $data = \DB::select('call getPDS_Dashboard');
        $result = json_decode(json_encode($data),true);

        $getEmployeeType = \DB::select('call getPDS_employeetype');
        $result1 = json_decode(json_encode($getEmployeeType),true);
        
        return view('Employee/emphome', compact('result', 'result1'));
    }
}
