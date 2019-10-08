<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeViewController extends Controller
{
    public function home(){

        $data = \DB::select('call getPDS_Dashboard');
        $result = json_decode(json_encode($data),true);
    	return view('Employee/emphome', compact('result'));
    }
}
