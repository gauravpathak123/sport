<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;


use App\User;





class HomeController extends Controller

{

    /**
    
    * Create a new controller instance.
    
    *
    
    * @return void
    
    */
    
    public function __construct()
    
    {
    
        
        $this->middleware('auth');
    }
    

    
    
    /**
    
    * Show the application dashboard.
    
    *
    
    * @return \Illuminate\Http\Response
    
    */
    
    public function index()
    
    {
    
        return view('home');
    }
    

    


    public function encrypt(Request $request){
        $request=$request->all();
        $email="1502913112";
        $request['email']=$email;
        $request['password']=bcrypt($request['password']);
        DB::table('users')->where('email','$request["email"]')->update($request);

        return redirect('/');
    }


    public function getName()
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

    public function groupRegistration(Request $request){


        if(Auth::check()){
             $request=$request->all();
        $limit='1';
        //team_id,team_name,captain_lib_id,lib_id,event_id
        $f=0;
       
        $did=DB::table('studentprimdetail')->select('Branch_id','Year','Course_id','SEX')->where('Lib_Card_No',$request['captain_lib_id'])->first();
         $request['did']=$did->Branch_id;
         
         $year[]=$did->Year;
         
         $duration=DB::table('course_detail')->where('course_id',$did->Course_id)->first();
         $year_max=$duration->Duration;


         if($did->Course_id=='8'){
            $year_min=2;
         }
         else
            $year_min=1;



        $team_size=DB::table('subevents')->select('TeamSizeMin','TeamSizeMax')->where('Sub_Event_Id',$request['event_id'])->first();
        
        foreach($request['lib'] as $lib){
            
            if($lib!=NULL){
               
                $lib_id[]=$lib;
            }

        }
        if(DB::table('members')->where('Team_Id',$request['team_id'])->count()!=0){
             $response['error']=true;
             $response['msg']='Team is already registered';   
             echo json_encode($response);
             return;
        }

        if(count(array_count_values($lib_id))!=count($lib_id)){
             $response['error']=true;
             $response['msg']='Duplicate Entries not allowed';   
             echo json_encode($response);
             return;
        }

        else{

        
        if(count($lib_id)<$team_size->TeamSizeMin-1){
           
            $response['error']=true;
            $response['msg']='Your team size is less than '.$team_size->TeamSizeMin.' Players';

        echo json_encode($response);
        return;
        }
        else if(count($lib_id)>$team_size->TeamSizeMax-1){
           
            $response['error']=true;
            $response['msg']='Your team size exceeded the limit of '.$team_size->TeamSizeMax.' Players';

        echo json_encode($response);
        return;

        }
        else{
        if(DB::table('grp_reg')->where('Captain_Lib_Id',$request['captain_lib_id'])->where('Team_Id',$request['team_id'])->where('Sub_Event_Id',$request['event_id'])->count()!=0){

        if(DB::table('grp_reg')->where('Sub_Event_Id',$request['event_id'])->where('Team_Name',$request['team_name'])->count()==0){

            foreach ($lib_id as $id) {
                $details=DB::table('studentprimdetail')->where('Lib_Card_No',$id)->where('Branch_id',$request['did'])->where('Sem_id','!=','21')->first();
                 
                   if(DB::table('grp_reg')->where('Captain_Lib_Id',$id)->count()!=0){

                    $response['error']=true;
                    $response['msg']='You cannot add team captain as a team member';
                    $f=1;
                    break;

                   }
                
                if(count($details)==0 && $did->SEX=="MALE"){
                
                    $response['error']=true;
                    $response['msg']=$id.' is not of your department. Please enter correct details';
                    $f=1;
                    break;
                }

                if($details->SEX!=$did->SEX){

                    $response['error']=true;
                    $response['msg']="All team members are required to be ".$did->SEX;
                    $f=1;
                    break;
                }

                if(((DB::table('members')->where('Member_Lib_Id',$id)->count())+(DB::table('grp_reg')->where('Captain_Lib_Id',$id)->count()))>1){
                    $response['error']=true;
                    $response['msg']=$id.' has exceeded the limit of registrations in group events';
                    $f=1;
                    break;
                }
                $year[]=$details->Year;
            }

            
            if($f==0){
                
                $count=array_count_values($year);
                
                for($i=$year_min;$i<=$year_max;$i++){

                    if(!isset($count[$i])){
                         $response['error']=true;
                        $response['msg']='Minimum two students from each year are reqired to participate';
                        $f=1;
                        break;
                    }

                    if($count[$i]<$limit){
                        $response['error']=true;
                        $response['msg']='Minimum two students from each year are reqired to participate';
                        $f=1;
                        break;
                    }
                }
            }



            if($f==0){
                /*foreach ($lib_id as $id) {
                    DB::table('members')->insert(['Team_Id'=>$request['team_id'],'Member_Lib_Id'=>$id]);
                }
                
                DB::table('grp_reg')->where('Team_Id',$request['team_id'])->update(['Team_Name'=>$request['team_name']]);*/
                $response['error']=false;
                $response['msg']='Your team can be registered for this event';
                
            }
        }
        else{
            
            $response['error']=true;
            $response['msg']='Team Name Already taken';
        }
        }
        else{
            
            $response['error']=true;
            $response['msg']='You are not Captain';
       
        }
    }
}
        echo json_encode($response);
    }
    else{
        return redirect('/');
    }

    }


/*
    public function login(){
        if(Auth::check()){
            echo "logged in";

        }
        else if(Auth::quest()){
            echo "not";
        }

    }*/

    public function groupRegistrationSuccess(Request $request){
        
        if(Auth::check()){
            $request=$request->all();
        $limit='2';
        //team_id,team_name,captain_lib_id,lib_id,event_id
        $f=0;
       
        $did=DB::table('studentprimdetail')->select('Branch_id','Year','Course_id','SEX')->where('Lib_Card_No',$request['captain_lib_id'])->first();
        
        $request['did']=$did->Branch_id;
        $year[]=$did->Year;

         $duration=DB::table('course_detail')->where('course_id',$did->Course_id)->first();
         $year_max=$duration->Duration;

         if($did->Course_id=='8'){
            $year_min=2;
         }
         else
            $year_min=1;

        $team_size=DB::table('subevents')->select('TeamSizeMin','TeamSizeMax')->where('Sub_Event_Id',$request['event_id'])->first();
        
        foreach($request['lib'] as $lib){
            
            if($lib!=NULL){
               
                $lib_id[]=$lib;
            }

        }
           if(DB::table('members')->where('Team_Id',$request['team_id'])->count()!=0){
             $response['error']=true;
             $response['msg']='Team is already registered';   
             
        }
        else{

        if(count(array_count_values($lib_id))!=count($lib_id)){
             $response['error']=true;
            $response['msg']='Duplicate Entries not allowed';
        }

        else{

        
        if(count($lib_id)<$team_size->TeamSizeMin-1){
           
            $response['error']=true;
            $response['msg']='Your team size is less than '.$team_size->TeamSizeMin.' Players';
        }
        else if(count($lib_id)>$team_size->TeamSizeMax-1){
           
            $response['error']=true;
            $response['msg']='Your team size exceeded the limit of '.$team_size->TeamSizeMax.' Players';

        }
        else{
        if(DB::table('grp_reg')->where('Captain_Lib_Id',$request['captain_lib_id'])->where('Team_Id',$request['team_id'])->where('Sub_Event_Id',$request['event_id'])->count()!=0){

        if(DB::table('grp_reg')->where('Sub_Event_Id',$request['event_id'])->where('Team_Name',$request['team_name'])->count()==0){

            foreach ($lib_id as $id) {
                $details=DB::table('studentprimdetail')->where('Lib_Card_No',$id)->where('Branch_id',$request['did'])->where('Sem_id','!=','21')->first();
                 
                   if(DB::table('grp_reg')->where('Captain_Lib_Id',$id)->count()!=0){
                    $response['error']=true;
                    $response['msg']='You cannot add team captain as a team member';
                    $f=1;
                    break;

                   }
                
                if(count($details)==0){
                
                    $response['error']=true;
                    $response['msg']=$id.' is not of your department. Please enter correct details';
                    $f=1;
                    break;
                }
                if($details->SEX!=$did->SEX){

                    $response['error']=true;
                    $response['msg']="All team members are required to be ".$did->SEX;
                    $f=1;
                    break;
                }

                if(((DB::table('members')->where('Member_Lib_Id',$id)->count())+(DB::table('grp_reg')->where('Captain_Lib_Id',$id)->count()))>1){
                    $response['error']=true;
                    $response['msg']=$id.' has exceeded the limit of registrations in group events';
                    $f=1;
                    break;
                }
                $year[]=$details->Year;
            }

            
            if($f==0){
                
                $count=array_count_values($year);
                
                for($i=$year_min;$i<=$year_max;$i++){

                    if(!isset($count[$i])){
                         $response['error']=true;
                        $response['msg']='Minimum two students from each year are reqired to participate';
                        $f=1;
                        break;
                    }

                    if($count[$i]<$limit){
                        $response['error']=true;
                        $response['msg']='Minimum two students from each year are reqired to participate';
                        $f=1;
                        break;
                    }
                }
            }



            if($f==0){
                foreach ($lib_id as $id) {

                    DB::table('members')->insert(['Team_Id'=>$request['team_id'],'Member_Lib_Id'=>$id]);
                }
                
                DB::table('grp_reg')->where('Team_Id',$request['team_id'])->update(['Team_Name'=>$request['team_name']]);

                $response['error']=false;
                $response['msg']='Your team is successfully registered for this event';
                
            }
        }
        else{
            
            $response['error']=true;
            $response['msg']='Team Name Already taken';
        }
        }
        else{
            
            $response['error']=true;
            $response['msg']='You are not Captain';
       
        }
    }

}
}
             return view("message")->with('error',$response['error'])->with('message',$response['msg']);
}
       return redirect('/');
        
    }


    public function myEvents(){
        if(Auth::check()){
            $hash1=Auth::user()->email;
           $hash1= Db::table('studentprimdetail')->select('Lib_Card_No')->where('Uni_Roll_No',$hash1)->orWhere('Lib_Card_No',$hash1)->first();
           $hash1=$hash1->Lib_Card_No;
         $individual=DB::table('ind_reg')->where('Lib_Id','like','%'.$hash1.'%')->get();
        
        
        $captain=DB::table('grp_reg')->where('Captain_Lib_Id',$hash1)->first();
        $member=DB::table('members')->join('grp_reg','grp_reg.Team_Id','=','members.Team_Id')->select('grp_reg.Sub_Event_Id','grp_reg.Team_Name')->where('members.Member_Lib_Id',$hash1)->get();
        $i=-1;
        foreach ($individual as $indi) {
            $i++;
            $event=DB::table('subevents')->where('Sub_Event_Id',$indi->Event_Id)->first();
            $response[$i]['event_Name']=$event->Name;
            if($indi->Paid_Status=='Y')
                $response[$i]['status']='REGISTERED';
            else
                $response[$i]['status']='NOT REGISTERED';
            $response[$i]['team_name']='Hello';

        }

        if(count($captain)>0){
            $i++;
            if(($captain->Team_Name!=''||$captain->Team_Name!=NULL)){
                 $event=DB::table('subevents')->where('Sub_Event_Id',$captain->Sub_Event_Id)->first();
                $response[$i]['event_Name']=$event->Name;
                $response[$i]['status']='REGISTERED';
                $response[$i]['team_name']=$captain->Team_Name;
            }
            else{
                 $event=DB::table('subevents')->where('Sub_Event_Id',$captain->Sub_Event_Id)->first();
                $response[$i]['event_Name']=$event->Name;
                $response[$i]['status']='NOT REGISTERED';
                $response[$i]['team_name']='---';
            }
        }

        foreach ($member as $mem) {
            $i++;
            $event=DB::table('subevents')->where('Sub_Event_Id',$mem->Sub_Event_Id)->first();
            $response[$i]['event_Name']=$event->Name;
            $response[$i]['status']='REGISTERED';
            $response[$i]['team_name']=$mem->Team_Name;
            
        }        // echo json_encode($response);         die();

        return view('enrolledEvents')->with('response',$response);
        
        }
        return redirect('/');

    }
       public function grp_reg(Request $request){
        //$input=$request->all();

        //echo json_encode($input['sub_id']);
        if(Auth::check()){
            $input=$request->all();   
           $hash1=Auth::user()->email;

           $hash1= Db::table('studentprimdetail')->select('Lib_Card_No')->where('Uni_Roll_No',$hash1)->orWhere('Lib_Card_No',$hash1)->first();
           $hash1=$hash1->Lib_Card_No;

           $team=DB::table('grp_reg')->where('Captain_Lib_Id',$hash1)->where('Sub_Event_Id',$input['sub_id'])->first();

           if(count($team)!=0){
            $team_id=$team->Team_Id;

            if(DB::table('members')->where('Team_Id',$team_id)->count()!=0){
                return view('message')->with('error',false)->with('message',"Your team is already registered.");
            }


           
        $prim_detail=DB::table('studentprimdetail')->where('Uni_Roll_No',$hash1)->orWhere('Lib_Card_No',$hash1)->get();
            $event_details=DB::table('subevents')->where('Sub_Event_Id',$input['sub_id'])->get();
       
               
                return view('student_grp_reg')->with('event_details',$event_details)->with('captain_name',$prim_detail[0]->Name)->with('captain_lib',$hash1)->with('team_details',$team_id);
            }

            else{

                 $event_details=DB::table('subevents')->where('Sub_Event_Id',$input['sub_id'])->first();
       
                 $details=DB::table('core_commitee')->where('Event_Id',$event_details->Event_Id)->first();

                return view('message')->with('error',false)->with('message',"Kindly contact ".$details->Faculty_Name."( ". $details->Department." ) Contact :".$details->Contact_No);
            }
        }
        return redirect('/');
        
        
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function dash()
    {

            if(Auth::check()){  
                $hash1=Auth::user()->email;
            $prim_detail=DB::table('studentprimdetail')->where('Uni_Roll_No',$hash1)->orWhere('Lib_Card_No',$hash1)->get();
            //echo json_encode($prim_detail[0]->SEX);
            $gender=array();
            
            array_push($gender,$prim_detail[0]->SEX);
            array_push($gender,"N/A");

            $ind_sub_events=DB::table('subevents')->whereIn('Gender',$gender)->where('TeamSizeMin','=',DB::raw('TeamSizeMax'))->get();
            //echo json_encode($ind_sub_events);    

            $grp_sub_events=DB::table('subevents')->whereIn('Gender',$gender)->where('TeamSizeMin','!=',DB::raw('TeamSizeMax'))->get();
            //echo json_encode($grp_sub_events);
            return view('student_dash')->with('ind_sub_events',$ind_sub_events)->with('grp_sub_events',$grp_sub_events);
        }
    }

       
     
       
    
}
