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
        return view('PDS_section/PDSmenu',compact('result2'));
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
        return view('pds_field/PDSField',compact('result','id','result2'));   
    }
    
    public function addSubfields(Request $request){
        $id = $request->input();
        $getID = $request->only('id');
        $Subfield_name = $request->input('Subfield_name');
        $sequence = $request->input('sequence');
        $input_type = $request->input('input_type');
        \DB::statement("CALL insert_Subfield('$Subfield_name','$sequence')");
        \DB::statement("CALL insert_fieldsubfield('{$getID['id']}')");

        $getSubfield = \DB::select('call getPDS_Subfield');
        $result3 = json_decode(json_encode($getSubfield),true);

        $getSection2 = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection2),true);

        $getInputType = \DB::select('call getPDS_inputtype');
        $result4 = json_decode(json_encode($getInputType),true);

        return view('pds_subfield/PDSSubfields',compact('id','result2','result3','result4'));
    }
}
