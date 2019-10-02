<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeInsertController extends Controller
{
    public function addForm (Request $request){
        $formcontent = $request->input();
        $formdataresult = json_decode(json_encode($formcontent),true);
        // dd($formcontent);

        $user_created = false;

        foreach($formdataresult as $key => $datavalue){
            // User generation
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
                $default_pass = password_hash("emp@123", PASSWORD_DEFAULT);
                
                
                \DB::statement("CALL insert_PDS_user('$user_comb', '$default_pass')"); // Store to PDS_user table
                $user_created = true;
            // End of User generation
            }
        }

        if($user_created == true){
            foreach($formdataresult as $key => $datavalue){
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
                    //  dd($datavalue[1]);
                     
                    \DB::statement("CALL insert_userdata('$datavalue[1]')");
                    switch ($datavalue[0]) {
                        case 1 : \DB::statement("CALL insert_datadigit('$datavalue[2]')"); break;
                        case 2 : \DB::statement("CALL insert_datatext('$datavalue[2]')"); break;
                        case 3 : \DB::statement("CALL insert_datafile('$datavalue[2]')"); break;
                        case 4 : \DB::statement("CALL insert_datadate('$datavalue[2]')"); break;
                    }
                }
            }
        }

        $getSection = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection),true);

        $getSectionCount =\DB::select('call getPDS_SectionCount');
        $resultCount = json_decode(json_encode($getSectionCount), true);

        $data = \DB::select('call getPDS_Dashboard');
        $result = json_decode(json_encode($data),true);
        
        return view('Employee/emphome', compact('result', 'result2', 'resultCount'));
    }

    public function searchbyUsername (Request $request){
        $formcontent = $request->input();
        $search_input = json_decode(json_encode($formcontent),true);
        // dd($search_input);
        foreach($search_input as $key => $datavalue){
            if($key == "username_input"){
                // $username_first = $datavalue[2]; 
                // dd($datavalue);
                $emp_data = \DB::select("call get_User_DatabyUsername('$datavalue')");
                $emp_dataresult = json_decode(json_encode($emp_data),true);
                // dd($emp_dataresult);
            }  
        }
        $data = \DB::select('call getPDS_Dashboard');
        $result = json_decode(json_encode($data),true);
        // dd($emp_dataresult);
        
        return view('Employee/empresult', compact('result', 'emp_dataresult'));
    }
}
