<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
    	return view('welcome');
    }

    public function PDSmenu(){
    	$getSection = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection),true);
    	return view('PDS_section/PDSmenu',compact('result2'));
    }

    public function addSection(Request $request){
    	$section = $request->input('section_name');
        $sequence = $request->input('sequence');
    	$data = array('Name' => $section,'Sequence' => $sequence);
    	 \DB::statement("CALL insert_section('$section','$sequence')");
    	$getSection = \DB::select('call getPDS_Section');
        $result = json_decode(json_encode($getSection),true);
        return view('PDS_section/PDSmenu',compact('result'));
    }

     public function PDSField(Request $request){
        $id = $request->input();
        $getID = $request->only('id');
        $getFields = \DB::select("call getPDS_Field('{$getID['id']}')");
        $result = json_decode(json_encode($getFields),true);

        $getSection2 = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection2),true);
        return view('pds_field/PDSField',compact('result','id','result2'));
    }

    public function addFields(Request $request){
        $id = $request->input();
        $getID = $request->only('id');
        $field = $request->input('field_name');
        $sequence = $request->input('sequence');
        $data = array('Name' => $field,'Sequence' => $sequence);
        \DB::statement("CALL insert_field('$field','$sequence')");
        \DB::statement("CALL insert_sectionfield('{$getID['id']}')");
        $getFields = \DB::select("call getPDS_Field('{$getID['id']}')");
        $result = json_decode(json_encode($getFields),true);
        return view('pds_field/PDSField',compact('result','id'));   
    }

    public function PDSSubfields(Request $request){
        $id = $request->input();
        return view('pds_subfield/PDSSubfields',compact('id'));
    }

    public function addSubfields(Request $request){
        $field = $request->input('field_name');
        $sequence = $request->input('sequence');
    }
}
