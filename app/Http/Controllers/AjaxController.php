<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

class AjaxController extends Controller
{
	public function getName()
	{
		if(!Auth::guest()){

			$hash1=Auth::user()->email;
        	$prim_detail=DB::table('studentprimdetail')->where('Uni_Roll_No',$hash1)->orWhere('Lib_Card_No',$hash1)->select('SEX','Branch_id','Lib_Card_No')->get();
	 		
	 		$lib=strtoupper($_GET['lib']);
	 		if($lib==$prim_detail[0]->Lib_Card_No){
	 			echo json_encode(array('error'=>true,'msg'=>"Captain Id not allowed"));
	 			return;
	 		}
	 		
	 		$sub_event_id=$_GET['sub_event_id'];

	 		//echo json_encode(array('error'=>true,'msg'=>"INVALID Lib_Id"));
	 		//return;
	        $name = DB::table('studentprimdetail')->where('Lib_Card_No', $lib)->get();
	        $event_details=DB::table('subevents')->where("Sub_Event_Id",$sub_event_id)->select('Gender','TeamSizeMin','TeamSizeMax')->get();


	        if(count($name)>0){

	        	//echo json_encode($name);
	        	if($prim_detail[0]->Branch_id!=$name[0]->Branch_id){
	        		echo json_encode(array('error'=>true,'msg'=>"Same branch allowed"));
		            return;
	        	}
	        	if($name[0]->Sem_id=="21"){
	        		echo json_encode(array('error'=>true,'msg'=>"Applied Science not allowed"));
		            return;
	        	}
	        	 if($event_details[0]->TeamSizeMin==2 && $event_details[0]->TeamSizeMax==2 && $event_details[0]->Gender=='N/A'){
		            if($prim_detail[0]->SEX=="MALE"){
		                $mem_dets=DB::table('studentprimdetail')->where('Lib_Card_No',$lib)->get();
		                
		                if(count($mem_dets)==0){
		                    echo json_encode(array('error'=>true,'msg'=>"INVALID Lib_Id"));
		                    return;
		                }
		                if($mem_dets[0]->SEX=="MALE"){
		                	echo json_encode(array('error'=>true,'msg'=>"SAME GENDER NOT ALLOWED"));
		                    return;
		                }
		            }   
		            else{
		                $mem_dets=DB::table('studentprimdetail')->select('SEX')->where('Lib_Card_No',$lib)->get();
		                if($mem_dets[0]->SEX=="FEMALE"){
		                    
		                    echo json_encode(array('error'=>true,'msg'=>"SAME GENDER NOT ALLOWED"));
		                    return;
		                }

		            }
		        }

		        if($event_details[0]->Gender!='N/A'){
		        	if($prim_detail[0]->SEX!=$name[0]->SEX){
		        		echo json_encode(array('error'=>true,'msg'=>"SAME GENDER ALLOWED"));
		                return;
		        	}
		        }

	        	$check1=DB::table('ind_reg')->select('Sub_Event_Id')->where('Lib_Id','LIKE','%'.$lib.'%')->where('Sub_Event_Id',$sub_event_id)->get();
	        		
	        	$check2=DB::table('ind_reg')->select('Sub_Event_Id')->where('Lib_Id','LIKE','%'.$lib.'%')->get();
        		$eve_id=array();
	            foreach($check2 as $ch){
	                $eve=DB::table('subevents')->where('Sub_Event_Id',$ch->Sub_Event_Id)->select('Event_Id')->get();
	                if(!in_array($eve[0]->Event_Id, $eve_id)){
	                    array_push($eve_id,$eve[0]->Event_Id);
	                }
	            }
	            //echo json_encode($check1);
	        	if(count($check1)>0){
	        		echo json_encode(array('error'=>true,'msg'=>"Member already registered"));
	        		return;
	        	}
	        	else if(count($eve_id)>=2){
		            	echo json_encode(array('error'=>true,'msg'=>"member already registered in 2 events"));
		            	return;
		       	}
	        	echo json_encode(array('error'=>false,'msg'=>$name[0]->Name));
	        	return;
	        }
	        else{
	        	echo json_encode(array('error'=>true,'msg'=>"INVALID Lib_Id"));
		        return;
	        }
	    }
	    else{
	    	return view('welcome');
	    }
	       
	}

	public function getTeam(){

		$team= $_GET['team'];
		$q_team=DB::table('ind_reg')->where('Team_Name',$team)->get();
		if(count($q_team)>0){
			echo json_encode(array('error'=>true,'msg'=>"Team Name already exists"));
			return;
		}
		$q_team=DB::table('grp_reg')->where('Team_Name',$team)->get();
		if(count($q_team)>0){
			echo json_encode(array('error'=>true,'msg'=>"Team Name already exists"));
			return;
		}

		echo json_encode(array('error'=>false,'msg'=>"Available"));

		return;		
	}
}