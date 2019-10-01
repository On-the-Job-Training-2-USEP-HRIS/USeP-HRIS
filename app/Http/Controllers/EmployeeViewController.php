<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeViewController extends Controller
{
    public function home(){
        $getEmployeeType = \DB::select('call getPDS_employeetype');
        $result1 = json_decode(json_encode($getEmployeeType),true);

        $data = \DB::select('call getPDS_Dashboard');
        $result = json_decode(json_encode($data),true);
    	return view('Employee/emphome', compact('result','result1'));
    }
}
