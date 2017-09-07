<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Routes;

class test extends Controller
{
    public function events(){
    	 $Events= DB::table('subevents')->join('event_details','subevents.Event_Id','=','event_details.E_Id')->select('subevents.*','event_details.*')->get();
    	
    	
    	
    	return view('welcome')->with('events',$Events);
    	
    	
    	
    }
    
    
 public function group(Request $request) {
    //return view('event');
 	$request=$request->all();
 	//echo json_encode($request);
 	$Test= DB::table('grp_reg')->join('subevents','grp_reg.Sub_Event_Id','=','subevents.Sub_Event_Id')->join('studentprimdetail','grp_reg.Captain_Lib_Id','=','studentprimdetail.Lib_Card_No')->join('dept_detail','studentprimdetail.Branch_id','=','dept_detail.Did')->select('grp_reg.Captain_Lib_Id','grp_reg.Team_Name','subevents.Sub_Event_Name','subevents.Sub_Event_Id','studentprimdetail.MOB','studentprimdetail.Name','dept_detail.Branch')->where('grp_reg.Sub_Event_Id','=',$request)->get();
		
		//echo json_encode($Test);
	return view('event')->with('det', $Test);
}

public function individual(Request $request) {
    //return view('event');
 	$request=$request->all();
 	//echo json_encode($request);
 	$Test= DB::table('ind_reg')->join('subevents','ind_reg.Sub_Event_Id','=','subevents.Sub_Event_Id')->join('studentprimdetail','ind_reg.Lib_Id','=','studentprimdetail.Lib_Card_No')->join('dept_detail','studentprimdetail.Branch_id','=','dept_detail.Did')->select('ind_reg.Paid_Status','subevents.Sub_Event_Name','studentprimdetail.Name','studentprimdetail.MOB','dept_detail.Branch')->where('ind_reg.Sub_Event_Id','=',$request)->get();
		
		//echo json_encode($Test);
	return view('Individual')->with('det', $Test);
}

   
}
