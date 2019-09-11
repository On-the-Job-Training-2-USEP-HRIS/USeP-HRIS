<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
    	return view('welcome');
    }

    public function PDSmenu(){
    	$getSection = \DB::select('select * from pds_section');
    	return view('PDS_section/PDSmenu',['getSection' => $getSection]);
    }

    public function store(Request $request){
    	$section = $request->input('section_name');
    	$data = array('Name' => $section,'Sequence' => 1);
    	\DB::table('pds_section')->insert($data);
    	$getSection = \DB::select('select * from pds_section');
    	return view('PDS_section/PDSmenu',['getSection' => $getSection]);
    }
}
