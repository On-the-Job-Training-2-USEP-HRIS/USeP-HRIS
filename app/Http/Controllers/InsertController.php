<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsertController extends Controller
{
    public function addSection(Request $request){
    	$section = $request->input('section_name');
        $sequence = $request->input('sequence');
    	 \DB::statement("CALL insert_section('$section','$sequence')");
    	
        $getSection = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection),true);

        $getSectionCount =\DB::select('call getPDS_SectionCount');
        $resultCount = json_decode(json_encode($getSectionCount), true);

        return view('PDS_section/PDSmenu',compact('result2', 'resultCount'));
    }

    
    public function addFields(Request $request){
        $id = $request->input();
        $getID = $request->only('id');
        $field = $request->input('field_name');
        $sequence = $request->input('sequence');
        \DB::statement("CALL insert_field('$field','$sequence')");
        \DB::statement("CALL insert_sectionfield('{$getID['id']}')");
        $getFields = \DB::select("call getPDS_Field('{$getID['id']}')");
        $result = json_decode(json_encode($getFields),true);

        $getSection = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection),true);

        $getSectionCount =\DB::select('call getPDS_SectionCount');
        $resultCount = json_decode(json_encode($getSectionCount), true);

        return view('pds_field/PDSField',compact('result','id','result2','resultCount'));   
    }
    
    public function addSubfields(Request $request){
        $id = $request->input();
        $getID = $request->only('id');
        $Subfield_name = $request->input('Subfield_name');
        $sequence = $request->input('sequence');
        $input_type = $request->input('input_type');

        \DB::statement("CALL insert_Subfield('$Subfield_name','$sequence')");
        \DB::statement("CALL insert_fieldsubfield('{$getID['id']}')");

        \DB::statement("CALL insert_SubfieldInputType('$input_type')");

        $getSubfield = \DB::select("call getPDS_Subfield('{$getID['id']}')");
        $result3 = json_decode(json_encode($getSubfield),true);

        $getSection2 = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection2),true);

        $getInputType = \DB::select('call get_input_type_group');
        $result4 = json_decode(json_encode($getInputType),true);

        $getSectionCount =\DB::select('call getPDS_SectionCount');
        $resultCount = json_decode(json_encode($getSectionCount), true);

        return view('pds_subfield/PDSSubfields',compact('id','result2','result3','result4','resultCount'));
    }

    public function addForm (Request $request){
        $formcontent = $request->input();
        $formdataresult = json_decode(json_encode($formcontent),true);
        // dd($formcontent);

        foreach($formdataresult as $key => $datavalue){

            // User generation
            if($key == "1"){
                $username_first = $datavalue[2]; // First half of username generation : Surname
            }
            if($key == "2"){
                $username_last = $datavalue[2]; // Second half of username generation
                $last_userid = \DB::select('call getPDS_userID'); // Select the latest employee ID to be added to username : First Name
                $last_userid_result = $last_userid[0] -> maxID;
                $user_comb = strtolower(str_replace(' ', '', $username_first . "." . $username_last)) . "." . ($last_userid_result + 1); // Username combination of first and second half with the latest employee ID
                $default_pass = password_hash("emp@123", PASSWORD_DEFAULT);
                // dd($user_comb);

                \DB::statement("CALL insert_PDS_user('$user_comb', '$default_pass')");
            // End of User generation

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
                 
                \DB::statement("CALL insert_userdata('$datavalue[1]')");
                switch ($datavalue[0]) {
                    case 1 : \DB::statement("CALL insert_datadigit('$datavalue[2]')"); break;
                    case 2 : \DB::statement("CALL insert_datatext('$datavalue[2]')"); break;
                    case 3 : \DB::statement("CALL insert_datafile('$datavalue[2]')"); break;
                    case 4 : \DB::statement("CALL insert_datadate('$datavalue[2]')"); break;
                }
            }
        }

        $getSection = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection),true);

        $getSectionCount =\DB::select('call getPDS_SectionCount');
        $resultCount = json_decode(json_encode($getSectionCount), true);

        $data = \DB::select('call getPDS_Dashboard');
        $result = json_decode(json_encode($data),true);
        
        return view('Employment/employment', compact('result', 'result2', 'resultCount'));
    }

}
