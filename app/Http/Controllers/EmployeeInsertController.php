<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeInsertController extends Controller
{
    
    public function addForm (Request $request){
        $formcontent = $request->input();
        $formdataresult = json_decode(json_encode($formcontent),true);

        $user_created = false; // Declaration needed before inserting data into database
        $no_errors = false; // Declaration needed for prevention on sql injection
        $error_data = [];
        
        foreach($formdataresult as $key => $datavalue){
            if($key > 0){
                if(isset($datavalue[2])){
                    if(!preg_match("/^[A-Za-z0-9-_=+,.:;!?%^&*()@# ]*$/", $datavalue[2])){
                        array_push($error_data, $datavalue[2]);
                    }
                }
            }
        }
        
        if(empty($error_data)){
            $no_errors = true;
        }

        if($no_errors == true){ // If no sql injection characters are found, execute user generation
            foreach($formdataresult as $key => $datavalue){
                // User credentials generation
                if($key == "1"){
                    $username_first = $datavalue[2]; // First half of username generation : Surname
                }
                if($key == "2"){
                    $username_last = $datavalue[2]; // Second half of username generation
                    $last_userid = \DB::select('call getPDS_userID'); // Select the latest employee ID to be added to username : First Name
                    $last_userid_result = $last_userid[0] -> maxID;
                    if ($last_userid_result == NULL){ // Handles the first user creation
                        $last_userid_result = 0;
                    }
                    $user_comb = strtolower(str_replace(' ', '', $username_first . "." . $username_last)) . "." . ($last_userid_result + 1); // Username combination of first and second half with the latest employee ID
                    $default_pass = password_hash("user@123", PASSWORD_DEFAULT);
                
                    \DB::statement("CALL insert_PDS_user('$user_comb', '$default_pass')"); // Store to PDS_user table
                    $user_created = true;
                // End of User generation
                }
            }
        }
        

        if($user_created == true){
            foreach($formdataresult as $key => $datavalue){
                if($key > 0){      
                    // datavalue[0] Group ID
                    // datavalue[1] Fieldsubfied ID
                    // datavalue[2] Data
                    if ( ! isset($datavalue[2])) {
                        if ($datavalue[0] == 4){
                            $datavalue[2]= '0001-01-01'; // 1970-01-01 00:00:00 will be input in the database
                        } else if ($datavalue[0] == 1){
                            $datavalue[2] = "0";    // Digit does not accept Null
                        } else {
                            $datavalue[2] = null;
                        }
                     }
                     // Filtering of data to be inserted into database table according to data group
                    \DB::statement("CALL insert_userdata('$datavalue[1]')");
                    switch ($datavalue[0]) {
                        case 1: \DB::statement("CALL insert_datadigit('$datavalue[2]')"); break;
                        case 2: \DB::statement("CALL insert_datatext('$datavalue[2]')"); break;
                        case 3:
                            $encodedfile = base64_encode($datavalue[2]); 
                            \DB::statement("CALL insert_datafile('$encodedfile')"); break;
                        case 4: \DB::statement("CALL insert_datadate('$datavalue[2]')"); break;
                    }
                }
            }
        }


        $data = \DB::select('call getPDS_Dashboard');
        $result = json_decode(json_encode($data),true);
        
        return view('Employee/emphome', compact('result', 'user_comb', 'error_data'));
    }

    public function searchbyUsername (Request $request){
        $formcontent = $request->input();
        $search_input = json_decode(json_encode($formcontent),true);
        foreach($search_input as $key => $datavalue){
            if($key == "username_input"){
                $searchUserID = json_decode(json_encode(\DB::select("call get_UserID_byUsername('$datavalue')")),true);
                $searchUserIDresult = $searchUserID[0]["id"];
                $emp_dashdata = \DB::select("call get_DashboardData_byUsername('$datavalue')");
                $emp_dashdataresult = json_decode(json_encode($emp_dashdata),true);
            }  
        }
        return view('Employee/empresult', compact('emp_dashdataresult', 'searchUserIDresult'));
    }

    public function updateData (Request $request){
        $formcontent = $request->input();
        $formdataresult = json_decode(json_encode($formcontent),true);
        $idFound = false;
        $userID = NULL;

        foreach($formdataresult as $key => $datavalue){
            if($key == "userID"){
                $userID = $datavalue;
                $idFound = true;
            }
        }

        if($idFound == true){
            foreach($formdataresult as $key => $datavalue){
                if($key > 1){
                    // datavalue[0] Group ID
                    // datavalue[1] Fieldsubfied ID
                    // datavalue[2] Data
                    if ( ! isset($datavalue[2])) {
                        if ($datavalue[0] == 4){
                            $datavalue[2]= '0001-01-01'; // 1970-01-01 00:00:00 will be input in the database
                        } else if ($datavalue[0] == 1){
                            $datavalue[2] = "0";    // Digit does not accept Null
                        } else {
                            $datavalue[2] = null;
                        }
                     }
                    switch ($datavalue[0]) {
                        case 1: \DB::statement("CALL update_DataDigit('$datavalue[2]', '$datavalue[1]', '$userID')"); break;
                        case 2: \DB::statement("CALL update_DataText('$datavalue[2]', '$datavalue[1]', '$userID')"); break;
                        case 3:
                            $encodedfile = base64_encode($datavalue[2]); 
                            \DB::statement("CALL update_DataFile('$encodedfile', '$datavalue[1]', '$userID')"); break;
                        case 4: \DB::statement("CALL update_DataDate('$datavalue[2]', '$datavalue[1]', '$userID')"); break;
                    }
                }
            }
        }

        $usernamefromID = json_decode(json_encode(\DB::select("call get_Username_byID('$userID')")),true);
        $usernamefromIDresult = $usernamefromID[0]["username"];
        $emp_dashdata = \DB::select("call get_DashboardData_byUsername('$usernamefromIDresult')");
        $emp_dashdataresult = json_decode(json_encode($emp_dashdata),true);
        $searchUserIDresult = $userID;        
        
        return view('Employee/empresult', compact('emp_dashdataresult', 'searchUserIDresult'));
    }
}
