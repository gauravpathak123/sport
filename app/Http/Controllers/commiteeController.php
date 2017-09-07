<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// .........................SHREY...............................
class commiteeController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth');
    }


	 public function studentCommittee(){

	 	//  EVENTS
	 	$event_name=DB::table('event_details')->get();
	 	$i=0;
	 	foreach ($event_name as $e) {

	 		$event_arr[$i]['name']=$e->Event_name;
	 		$event_arr[$i]['id']=$e->E_Id;
	 		$i++;
	 		# code...
	 	}
	 	echo json_encode($event_arr);

	 	

	 	return view('show_student_committe')->with('Event_Name',$event_arr);
		
	}
	public function getStudentApexCoordinator()
	{
		$e_id=$_GET['eventId'];

		//  STUDENT APEX 

	 	$apex=DB::table('student_committee')->where([['Type','=','APEX'],['Event_id','=',$e_id]])->get();
	 	$i=0;

	 	foreach ($apex as $lib_id) {
	 		//$apex_Id[$lib_id->Id]=$lib_id->Id;

	 	//$apex_phone[$lib_id->Id]=$lib_id->phone_no;

	 	$details=DB::table('studentprimdetail')->where('Lib_Card_No',$lib_id->Student_id)->first();
	 	//$apex_name[$lib_id->Id]=$details->Name;

		$event=DB::table('event_details')->where('E_Id',$e_id)->first();
		//$apex_event[$lib_id->Id]=$event->Event_name;

		$branch=DB::table('dept_detail')->where('Did',$details->Branch_id)->first();
		//$apex_branch[$lib_id->Id]=$branch->Branch;
/*
		echo "<td>".$details->Name."</td>";
		echo "<td>".$details->Year."</td>";
		echo "<td>".$lib_id->phone_no."</td>";
		echo "<td>".$event->Event_name."</td>";
		echo "<td>".$branch->Branch."</td>";*/

		$apex_details[$i]['Aname']=$details->Name;
		$apex_details[$i]['Ayear']=$details->Year;
		$apex_details[$i]['Aphone']=$lib_id->phone_no;
		$apex_details[$i]['Aevent']=$event->Event_name;
		$apex_details[$i]['Abranch']=$branch->Branch;
		$i++;
	 	}
	 	/*$APEX[0]['apex_name']=$apex_name;
	 	$APEX[1]['apex_event']=$apex_event;
	 	$APEX[2]['apex_branch']=$apex_branch;
	 	$APEX[3]['apex_phone']=$apex_phone;*/
	 	//echo json_encode($APEX);

	


	 	
	
	 	

	 	//STUDENT COORDINATOR

	 	$coordinator=DB::table('student_committee')->where([['Type','=','COORDINATOR'],['Event_Id','=',$e_id]])->get();
	 	$i=0;
	 	foreach ($coordinator as $libr_id) {
	 		//$coordinator_Id[$libr_id->Id]=$libr_id->Id;

	 	//$coordinator_phone[$libr_id->Id]=$libr_id->phone_no;

	 	$details=DB::table('studentprimdetail')->where('Lib_Card_No',$libr_id->Student_id)->first();
	 	//$coordinator_name[$libr_id->Id]=$details->Name;

		$event=DB::table('event_details')->where('E_Id',$e_id)->first();
		//$coordinator_event[$libr_id->Id]=$event->Event_name;

		$branch=DB::table('dept_detail')->where('Did',$details->Branch_id)->first();
		//$coordinator_branch[$libr_id->Id]=$branch->Branch;


			//echo json_encode($coordinator_name);

		$coordinator_details[$i]['Cname']=$details->Name;
		$coordinator_details[$i]['Cyear']=$details->Year;
		$coordinator_details[$i]['Cphone']=$lib_id->phone_no;
		$coordinator_details[$i]['Cevent']=$event->Event_name;
		$coordinator_details[$i]['Cbranch']=$branch->Branch;
		$i++;
	 	}

	 	echo json_encode(array('Apex' => $apex_details,'Coord'=> $coordinator_details));

	 	//return view('show_student_committe')->with('apex_details',$apex_details)->with('coordinator_details',$coordinator_details);

	}
	public function removeCommitteMember()
	{
		$studentId='1519EN1116';
		$exist=DB::table('student_committee')->where('Student_id',$studentId)->first();
		if(count($exist)==0)
		{
			echo json_encode(array('error'=>true,'msg'=>"Record doesn't exist"));
    return view('message')->with('error',true)->with('message',"Record doesn't exist");	
		}
		else
		{
		DB::table('student_committee')->where('Student_id',$studentId)->delete();

    return view('message')->with('error',true)->with('message',"Successful");	
		}
		
	}

	public function addApexCoordinator()
	{
		$pmail=Auth::user()->email;
		$eventName='Cricket';
		//$pmail=15307;
		$studentId='1519EN1116';
		$type='APEX';
		$phone='1232341223234';

		 $exist_studentId=DB::table('studentprimdetail')->where('Lib_Card_No',$studentId)->get();
        if(count($exist_studentId)!=0)
{
        $cap=DB::table('student_committee')->select('*')->where('Student_id',$studentId)->first();
        $branch_course=DB::table('studentprimdetail')->select('Name','Course_id','Branch_id','Sem_id')->where('Lib_Card_No',$studentId)->first();
        if($branch_course->Sem_id!=21)
        {
            
                if(count($cap)==0)
                    {

                        $event_id=DB::table('event_details')->select('E_Id')->where('Event_name',$eventName)->first();
                        DB::table('student_committee')->insert(['Student_id'=>$studentId,'Event_id'=>$event_id->E_Id,'phone_no'=>$phone,'created_by'=>$pmail,'Type'=>$type]);   
                       // echo $event_id->E_Id;

                        $response['error']=false;
                        $response['mssg']=$branch_course->Name." (".$studentId.") "." added as ".$type;
                        echo json_encode($response);
    return view('message')->with('error',$response['error'])->with('message',$response['mssg']);

                   }
               else
                   {
                        
                        
                                 $response['error']=true;
                                $response['mssg']="Oops !! You are already an Event Apex or Coordinator";
                                echo json_encode($response);
    return view('message')->with('error',$response['error'])->with('message',$response['mssg']);
                            
                   }
        }
       else
       {
        
                 $response['error']=true;
                $response['mssg']="B.Tech First Year not allowed to participate";
                echo json_encode($response);

    return view('message')->with('error',$response['error'])->with('message',$response['mssg']);
         
          
        }
}
else
{
    $response['error']=true;
    $response['mssg']=" Invalid Library Id";
    echo json_encode($response);
    return view('message')->with('error',$response['error'])->with('message',$response['mssg']);
   }


		//return view('addApexCoordinator');
	}


}