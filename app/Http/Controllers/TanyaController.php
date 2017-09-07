<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;

class TanyaController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }


    public function individualEvents(){
        if(Auth::check()){
        $Events= DB::table('subevents')->join('event_details','subevents.Event_Id','=','event_details.E_Id')->where('event_details.Type','=','I')->select('subevents.*','event_details.*')->get();
        
        
        
        return view('paidReport')->with('events',$Events);
        
        }
        else
        {
            redirect("/");
        }
        
    }
     public function registeredStudents(){
        if(Auth::check()){
         $Events= DB::table('subevents')->join('event_details','subevents.Event_Id','=','event_details.E_Id')->where('event_details.Type','=','G')->select('subevents.*','event_details.*')->get();        
        
        
        
        return view('registered')->with('events',$Events);
        }
        else{
            return redirect("/");
        }
        
        
    }
    
    
 public function groupEventDetails(Request $request) {

    if(Auth::check()){
    //return view('event');
    $request=$request->all();
      //echo json_encode($request);

    $Test= DB::table('grp_reg')->join('subevents','grp_reg.Sub_Event_Id','=','subevents.Sub_Event_Id')->join('studentprimdetail','grp_reg.Captain_Lib_Id','=','studentprimdetail.Lib_Card_No')->join('dept_detail','studentprimdetail.Branch_id','=','dept_detail.Did')->select('grp_reg.Captain_Lib_Id','grp_reg.Team_Name','subevents.Name as event_name','grp_reg.Team_Id','subevents.Sub_Event_Id','studentprimdetail.MOB','studentprimdetail.Name','dept_detail.Branch')->where('grp_reg.Sub_Event_Id','=',$request['event'])->get();
    $teams=[];
    foreach ($Test as $t) {
        if(DB::table('members')->where('Team_Id',$t->Team_Id)->count()!=0){
            $teams[]=$t;
        }
        
    }

    if(count($teams)==0){
     return view('message')->with('error',false)->with('message',"No registered students for this event");
    }
  
    return view('group_reg')->with('det', $teams);
    
}
    return redirect("/");
}

public function individualEventDetails(Request $request) {
    if(Auth::check()){
    //return view('event');
    $request=$request->all();
    //echo json_encode($request);
    $Test= DB::table('ind_reg')->join('subevents','ind_reg.Sub_Event_Id','=','subevents.Sub_Event_Id')->join('studentprimdetail','ind_reg.Lib_Id','=','studentprimdetail.Lib_Card_No')->join('dept_detail','studentprimdetail.Branch_id','=','dept_detail.Did')->select('ind_reg.Paid_Status','subevents.Name as event_name','studentprimdetail.Name','studentprimdetail.Lib_Card_No','studentprimdetail.MOB','dept_detail.Branch')->where('ind_reg.Sub_Event_Id','=',$request['event'])->get();
        
        //echo json_encode($Test);
    return view('Individual')->with('det', $Test);
}
     return redirect("/");
}

   
}
