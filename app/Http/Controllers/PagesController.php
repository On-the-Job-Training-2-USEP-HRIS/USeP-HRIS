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
        $result = json_decode(json_encode($getSection),true);
    	return view('PDS_section/PDSmenu',compact('result'));
    }

    public function PDSmenulist(){
    	$getSection = \DB::select('call getPDS_Section');
        $result = json_decode(json_encode($getSection),true);
    	return view('/layout',compact('result'));
    }

    public function store(Request $request){
    	$section = $request->input('section_name');
        $sequence = $request->input('sequence');
    	$data = array('Name' => $section,'Sequence' => $sequence);
    	\DB::table('pds_section')->insert($data);
    	$getSection = \DB::select('call getPDS_Section');
        $result = json_decode(json_encode($getSection),true);
        return view('PDS_section/PDSmenu',compact('result'));
    }

     public function PDSField(){
	  return view('pds_section/PDSField');
	 }
}
