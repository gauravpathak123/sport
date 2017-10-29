<?php

namespace App\Http\Controllers;
use Alert;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator; 

use Illuminate\Support\Facades\Auth;



// .........................SHREY...............................



class adminController extends Controller

{

    
    
    public function __construct()
    
    {
    
        $this->middleware('auth');
    }
    

    
    
    public function getCaptainName()
    
    {
    
        $lib=$_GET['lib'];

        
        
        $name = DB::table('studentprimdetail')->where('Lib_Card_No', $lib)->get();
        
        if(count($name)>0){
        
            $arr=array('error'=>false,'msg'=>$name[0]->Name);
            
            //echo $name[0]->Name;
            
            return json_encode($arr);
            
        }
        
        else{
        
            $arr=array('error'=>true,'msg'=>"Please enter valid id");
            
            return json_encode($arr);
            
        }
        
        
    }


    public function addTeamCaptain()
    {
         if(Auth::check()){
        $pmail=Auth::user()->email;
        if(Auth::user()->Hash3!="Student"){
    	$dept=DB::table('dept_detail')->get();
    	$dept_arr=array();

        //$pmail=5988;
        $event_id=DB::table('core_commitee')->select('Event_Id')->where('Pmail',$pmail)->first();
        //$event=DB::table()
       
        $event_id_arr=explode(',', $event_id->Event_Id);
        //$event_name_arr=explode(',', $event_id->Event_Name);
        foreach ($event_id_arr as $e) {
           
            $event_names=DB::table('subevents')->where('Event_Id',$e)->get();
           //$event_names_arr=explode(',', $event_names[0]->Name);
           foreach ($event_names as $ename) {
            $event_names_arr[$ename->Sub_Event_Id]=$ename->Name;
           }
        }
        
      
        
    	return view('addCaptain')->with('dept',$dept)->with('event_name_arr',$event_names_arr);
    }

    return view('message')->with('error',true)->with('message','You are not an authorized user');
}
    return redirect('/');
}



    public function submit(Request $request)
    {
        if(Auth::check()){
            if(Auth::user()->Hash3!="Student"){
    
    $v=Validator::make($request->all(),[
                'LibId'=>'required',
                'Event'=>'required',
                'Dept'=>'required',
                ]);
            if($v->fails()){

    return redirect()->back();
            }
        $request=$request->all();
         $captainId=strtoupper($request['LibId']);
        $name_event=$request['Event'];
        $dept_id=$request['Dept'];

       /* if($captainId==''||$name_event==''||$dept_id=='')
        {
            
        }*/
    	

        $exist_capId=DB::table('studentprimdetail')->where('Lib_Card_No',$captainId)->get();
        if(count($exist_capId)!=0)
{
        $cap=DB::table('grp_reg')->select('*')->where('Captain_Lib_Id',$captainId)->first();
        $branch_course=DB::table('studentprimdetail')->select('Name','Course_id','Branch_id','Sem_id','SEX')->where('Lib_Card_No',$captainId)->first();

        if($branch_course->Branch_id==$dept_id && $branch_course->Sem_id!=21 )
        {

            $already_member_count=DB::table('team_members')->where('Member_Lib_Id',$captainId)->get();
            $sub_event_id=DB::table('subevents')->select('Sub_Event_Id')->where('Name',$name_event)->first();
            $another_cap=DB::table('grp_reg')->where('Sub_Event_Id',$sub_event_id->Sub_Event_Id)->first();
                if(count($cap)==0 && count($already_member_count)<=1 && count($another_cap)==0)
                    {
                      
                        
                        if(($sub_event_id->Sub_Event_Id%2==0&&$branch_course->SEX=='MALE')||($sub_event_id->Sub_Event_Id%2!=0&&$branch_course->SEX=='FEMALE'))
                        {

                        DB::table('grp_reg')->insert(['Captain_Lib_Id'=>$captainId,'Sub_Event_Id'=>$sub_event_id->Sub_Event_Id]);   
                       
                        $response['error']=false;
                        $response['mssg']=$branch_course->Name." (".$captainId.") "." added as Captain for ".$name_event." Team";
                       }
                    else{

                          $response['error']=true;
                        $response['mssg']="Sorry !! Female Student can head only Girls Team while Male Student can head only Boys Team.";
                        }

                          

                   }
               else
                   {
                        if(count($already_member_count)>1)
                        {
                            $response['error']=true;
                            $response['mssg']="Oops !! Your Participation Limit Exceeded";
                        
                        }
                        else if(count($cap)!=0)
                            {
                                 $response['error']=true;
                                $response['mssg']="Oops !! You are already a captain for an event";
                                
                            }
                        else if(count($another_cap)!=0)
                            {
                                 $response['error']=true;
                        $response['mssg']="Captain Already assigned for this Department for ".$name_event;
                               ;
                            }
                   }
        }
       else
       {
        if($branch_course->Sem_id==21)
            {
                 $response['error']=true;
                $response['mssg']="B.Tech First Year not allowed to participate";
            
            }
        else
            {
                $response['error']=true;
                $response['mssg']="Student should be of same department as the selected one";
               
            }
          
        }
}
else
{
    $response['error']=true;
    $response['mssg']=" Invalid Library Id";
   
    
   }
    return redirect()->back()->with('alert', $response['mssg'])->with('error', $response['error']);
}
  return view('message')->with('error',true)->with('message','You are not an authorized user');     
}
   return redirect('/');
}

 
}
