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

        $getSectionCount =\DB::select('call getPDS_SectionCount');
        $resultCount = json_decode(json_encode($getSectionCount), true);

    	return view('PDS_section/PDSmenu',compact('result2', 'resultCount'));
    }

    public function PDSField(Request $request){
        $id = $request->input();
        $getID = $request->only('id');
        $getFields = \DB::select("call getPDS_Field('{$getID['id']}')");
        $result = json_decode(json_encode($getFields),true);

        $getSectionCount =\DB::select('call getPDS_SectionCount');
        $resultCount = json_decode(json_encode($getSectionCount), true);

        $getSection2 = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection2),true);
        return view('pds_field/PDSField',compact('result','id','result2', 'resultCount'));
    }

    public function PDSSubfields(Request $request){
        $id = $request->input();
        $getSection2 = \DB::select('call getPDS_Section');
        $result2 = json_decode(json_encode($getSection2),true);

        $getSectionCount =\DB::select('call getPDS_SectionCount');
        $resultCount = json_decode(json_encode($getSectionCount), true);

        $getSubfield = \DB::select('call getPDS_Subfield');
        $result3 = json_decode(json_encode($getSubfield),true);

        $getInputType = \DB::select('call getPDS_inputtype');
        $result4 = json_decode(json_encode($getInputType),true);

        $getInputGroup = \DB::select('call getPDS_inputgroup');
        $result5 = json_decode(json_encode($getInputGroup),true);

        $getSectionCount =\DB::select('call getPDS_SectionCount');
        $resultCount = json_decode(json_encode($getSectionCount), true);

        return view('pds_subfield/PDSSubfields',compact('id','result2','result3','result4','result5','resultCount'));
    }
}
