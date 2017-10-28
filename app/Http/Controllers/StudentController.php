<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Input;
//use GuzzleHttp\Client;

class StudentController extends Controller
{

//     public function __construct()
// {
//     $this->middleware('auth');
// }

    public function redirect(){
             $client = new Client();
    //     $res = $client->request('POST', 'http://www.kiet.edu', [
    //     'form_params' => [
    //         'client_id' => 'test_id',
    //         'secret' => 'test_secret',
    //     ]
    // ]);

    // $result= $res->getBody();
     $response = $client->request('GET', 'http://github.com');
echo $response->getStatusCode();


    //dd($result);
    }
    public function core_comittee(){
            $Test= DB::table('core_commitee')->get();
            //echo json_encode($Test);
            return view('core_comittee')->with('det', $Test);
    }

    public function dash()
    {
    	if(!Auth::guest()){

        	$hash1=Auth::user()->email;
        	$prim_detail=DB::table('studentprimdetail')->where('Uni_Roll_No',$hash1)->orWhere('Lib_Card_No',$hash1)->get();
        	//echo json_encode($prim_detail[0]->SEX);
        	$gender=array();
        	$ind_events=array();

        	array_push($gender,$prim_detail[0]->SEX);
        	array_push($gender,"N/A");

        	 $ind_sub_events=DB::table('subevents')->whereIn('Gender',$gender)->where('TeamSizeMin','=',DB::raw('TeamSizeMax'))->get();

            foreach ($ind_sub_events as $in) {
                $q_ch=DB::table('ind_reg')->where('Sub_Event_Id',$in->Sub_Event_Id)->where('Lib_Id','LIKE','%'.$prim_detail[0]->Lib_Card_No.'%')->get();
                //echo count(explode(',',$q_ch[0]->Lib_Id));
                //echo $ind_sub_events[0]->TeamSizeMin;
                if(count($q_ch)==0 || count(explode(',',$q_ch[0]->Lib_Id))<$in->TeamSizeMin){
                    array_push($ind_events, $in);
                }
            }
            // /dd(DB::getQueryLog());
           // echo json_encode($ind_events);
        	$grp_sub_events=DB::table('subevents')->whereIn('Gender',$gender)->where('TeamSizeMin','!=',DB::raw('TeamSizeMax'))->get();
        	//echo json_encode($grp_sub_events);
            return view('student_dash')->with('ind_sub_events',$ind_events)->with('grp_sub_events',$grp_sub_events);
        }
        else{
            return view('student_dash');
           // return Redirect('/');
        }
    }

    public function ind_reg(Request $request){

        if(Auth::guest()){
            return Redirect('/');
        }
    	$input=$request->all();
        if($input==NULL){
            return Redirect('/');
        }

        $hash1=Auth::user()->email;
       // echo $input['sub_id'];
        $prim_detail=DB::table('studentprimdetail')->where('Uni_Roll_No',$hash1)->orWhere('Lib_Card_No',$hash1)->get();

        $lib=$prim_detail[0]->Lib_Card_No;
        $check=DB::table('ind_reg')->where('Lib_Id','like','%'.$lib.'%')->get();

        $eve_id=array();
        foreach($check as $ch){
                $eve=DB::table('subevents')->where('Sub_Event_Id',$ch->Sub_Event_Id)->select('Event_Id')->get();
                // echo json_encode($eve);
                if(!in_array($eve[0]->Event_Id, $eve_id)){
                    array_push($eve_id,$eve[0]->Event_Id);
                }
        }

        if(count($eve_id)>=2){
              return view('message')->with('message','You are already registered in 2 individual events')->with('error',true); 
            //Session::flash('message', 'member registered in 2 events');
           // return redirect()->back();
        }

        else{
            $q=DB::table('ind_reg')->where("Lib_Id",'LIKE','%'.$lib.'%')->where('Sub_Event_Id',$input['sub_id'])->get();
            if(count($q)==0){
                DB::table('ind_reg')->insert(['Lib_Id'=>$lib,'Sub_Event_Id'=>$input['sub_id'],'Paid_Status'=>'N']);
            }
            $event_details=DB::table('subevents')->where('Sub_Event_Id',$input['sub_id'])->get();
            if($event_details[0]->TeamSizeMax==1){

                $participant=DB::table('ind_reg')->where("Lib_Id",'LIKE','%'.$lib.'%')->where('Sub_Event_Id',$input['sub_id'])->get();
                DB::table('ind_reg')->where('Lib_Id',$prim_detail[0]->Lib_Card_No)->where('Sub_Event_Id',$input['sub_id'])->update(['Add_Status'=>'Y']);
                $arr_lib=explode(',', $participant[0]->Lib_Id);
                
                $part_details=array();
                $i=0;
                foreach ($arr_lib as $lib) {
                    $q_name=DB::table('studentprimdetail')->select('Lib_Card_No','Name')->where('Lib_Card_No',$lib)->get();
                    $part_details[$i]['Name']=$q_name[0]->Name;
                    $part_details[$i]['lib']=$q_name[0]->Lib_Card_No;
                    $i++;
                }
                $amount=$event_details[0]->Amount*count($arr_lib);
               
                return view('payment')->with('event_details',$event_details)->with('participant',$part_details)->with('amount',$amount);
            }
            else{
        	    $team_details=DB::table('ind_reg')->where("Lib_Id",'LIKE','%'.$lib.'%')->where('Sub_Event_Id',$input['sub_id'])->get();
                return view('student_ind_reg')->with('event_details',$event_details)->with('captain_name',$prim_detail[0]->Name)->with('captain_lib',$lib)->with('team_details',$team_details);
            }
        }
    }

    public function grp_reg(Request $request){
    	$input=$request->all();

    	echo json_encode($input['sub_id']);
        return view('student_grp_reg');
    }

    public function addIndMembers(Request $request){

        if(Auth::guest()){
            return Redirect('/');
        }
        $input=$request->all();

        if($input==NULL){
            return Redirect('/');
        }
        $lib_ids=array();

        $team_name=$input['team_name'];
        if($team_name==""){
            return view('message')->with('message','Team Name required')->with('error',true);
        }
        $q_team=DB::table('ind_reg')->where('Team_Name',$team_name)->get();
        if(count($q_team)>0){
            return view('message')->with('message','Team Name already exists')->with('error',true);
           
        }
        $q_team=DB::table('grp_reg')->where('Team_Name',$team_name)->get();
        if(count($q_team)>0){
           return view('message')->with('message','Team Name already exists')->with('error',true);
        }

        $check1=DB::table('ind_reg')->select('Lib_Id','Sub_Event_Id')->where('Reg_Id',$input['team_id'])->get();
        $lib_ar=explode(',',$check1[0]->Lib_Id);

        $hash1=Auth::user()->email;
        $prim_detail=DB::table('studentprimdetail')->where('Uni_Roll_No',$hash1)->orWhere('Lib_Card_No',$hash1)->get();

        $lib=$prim_detail[0]->Lib_Card_No;
        
        $det=DB::table('subevents')->select('TeamSizeMin','TeamSizeMax','Gender')->where('Sub_Event_Id',$check1[0]->Sub_Event_Id)->get();
        if(count($lib_ar)>=$det[0]->TeamSizeMin){
            // Session::flash('message', 'Team Already registered');
             return view('message')->with('message','Team Already registered')->with('error',true);
        }

        if($det[0]->TeamSizeMin==2 && $det[0]->TeamSizeMax==2 && $det[0]->Gender=='N/A'){
            if($prim_detail[0]->SEX=="MALE"){
                $mem_id=$input['lib'][0];
                $mem_dets=DB::table('studentprimdetail')->where('Lib_Card_No',$mem_id)->get();
                
                if(count($mem_dets)==0){
                    return view('message')->with('message','INVALID Lib_Id')->with('error',true);
                }
                if($mem_dets[0]->SEX=="MALE"){
                    return view('message')->with('message','WRONG GENDER SELECTION')->with('error',true);
                }
            }   
            else{
                $mem_id=$input['lib'][0];
                $mem_dets=DB::table('studentprimdetail')->select('SEX')->where('Lib_Card_No',$mem_id)->get();
                if($mem_dets[0]->SEX=="FEMALE"){
                    
                     return view('message')->with('message','WRONG GENDER SELECTION')->with('error',true); 
                }

            }
        }

        foreach ($input['lib'] as $li) {
            
            if($li==$lib){
                return view('message')->with('message','Captain Id not allowed')->with('error',true);
            }
            $check2=DB::table('ind_reg')->where('Lib_Id','like','%'.$li.'%')->select('Sub_Event_Id')->get();
            $mem_det=DB::table('studentprimdetail')->select('SEX','Sem_id','Branch_id')->where('Lib_Card_No',$li)->get();
            
            if($det[0]->Gender!='N/A'){
                if($mem_dets[0]->SEX!=$prim_detail[0]->SEX){
                     return view('message')->with('message','SAME GENDER ALLOWED')->with('error',true);
                }
            }
            if(count($mem_det)==0){
                // Session::flash('message','Lib_Id not exists');
                 return view('message')->with('message','Lib_Id not exists');
            }

            if($mem_det[0]->Branch_id!=$prim_detail[0]->Branch_id || $mem_det[0]=='21'){
               // Session::flash('message','only members of same branch are allowed');
                return view('message')->with('message','only members of same branch are allowed')->with('error',true);
            }
            
            $eve_id=array();
            foreach($check2 as $ch){
                $eve=DB::table('subevents')->where('Sub_Event_Id',$ch->Sub_Event_Id)->select('Event_Id')->get();
                if(!in_array($eve[0]->Event_Id, $eve_id)){
                    array_push($eve_id,$eve[0]->Event_Id);
                }
            }
            if(count($eve_id)>=2){
               // Session::flash('message', 'member registered in 2 events');
                return view('message')->with('message','member registered in 2 events')->with('error',true);
                //return redirect()->back();
            }

            $check3=DB::table('ind_reg')->where('Lib_Id','like','%'.$li.'%')->where('Sub_Event_Id',$check1[0]->Sub_Event_Id)->get();
            //echo json_encode($check3);
            if(count($check3)>0){
                // Session::flash('message', 'member already registered');
                 return view('message')->with('message','member already registered')->with('error',true);
                  //return redirect()->back();
            }
            if(count(array_keys($lib_ar,$li))>0){
                //Session::flash('message', 'Duplicate entries');
                return view('message')->with('message','Duplicate entries')->with('error',true);
                 //return redirect()->back();
            }
            array_push($lib_ar,strtoupper($li));
        }
         if(count($lib_ar)<$det[0]->TeamSizeMin || count($lib_ar)>$det[0]->TeamSizeMax){
           // Session::flash('message', 'Insufficient Team members');
            return view('message')->with('message','Insufficient Team members')->with('error',true);
             //return redirect()->back();
         }
         else{
            DB::table('ind_reg')->where('Reg_Id',$input['team_id'])->update(['Lib_Id'=>implode(',', $lib_ar),'Add_Status'=>'Y','Team_Name'=>$team_name]);
            $event_details=DB::table('subevents')->where('Sub_Event_Id',$check1[0]->Sub_Event_Id)->get();
            
            $part_details=array();
            $i=0;
             foreach ($lib_ar as $lib) {
                $q_name=DB::table('studentprimdetail')->select('Lib_Card_No','Name')->where('Lib_Card_No',$lib)->get();
                //echo json_encode($q_name[0]);
                array_push($part_details, array('Name'=>$q_name[0]->Name,'lib'=>$q_name[0]->Lib_Card_No));
                //$i++;
            }
           // echo json_encode($event_details);
            $amount=$event_details[0]->Amount*count($lib_ar);
            //echo json_encode($part_details[0]['Name']);

            return view('payment')->with('event_details',$event_details)->with('participant',$part_details)->with('amount',$amount);

         }

         //return view('welcome');

        //echo json_encode($lib_ids);
    }

    public function my_events(Request $request){
      //  $hash1='1519IT1124';
        if(Auth::guest()){
            return Redirect('/');
        }
        $response=$request->all();
        $hash1=Auth::user()->email;
        $prim_detail=DB::table('studentprimdetail')->where('Uni_Roll_No',$hash1)->orWhere('Lib_Card_No',$hash1)->get();

        $hash1=$prim_detail[0]->Lib_Card_No;
        
         $individual=DB::table('ind_reg')->where('Lib_Id','like','%'.$hash1.'%')->get();
        //echo json_encode($individual);
        $captain=DB::table('grp_reg')->where('Captain_Lib_Id',$hash1)->first();
        $member=DB::table('members')->join('grp_reg','grp_reg.Team_Id','=','members.Team_Id')->select('grp_reg.Sub_Event_Id','grp_reg.Team_Name')->where('members.Member_Lib_Id',$hash1)->get();
        $i=-1;
        foreach ($individual as $indi) {
            $i++;
            $event=DB::table('subevents')->where('Sub_Event_Id',$indi->Sub_Event_Id)->first();
            $response[$i]['event_Name']=$event->Name;
            $response[$i]['sub_event_id']=$indi->Sub_Event_Id;
            if($indi->Paid_Status=='Y')
                $response[$i]['status']='PAID';
            else
                $response[$i]['status']='UNPAID';
            $response[$i]['team_name']=$indi->Team_Name;

        }

        if(count($captain)>0){
            $i++;
            if(($captain->Team_Name!=''||$captain->Team_Name!=NULL)){
                 $event=DB::table('subevents')->where('Sub_Event_Id',$captain->Sub_Event_Id)->first();
                $response[$i]['event_Name']=$event->Name;
                $response[$i]['status']='PAID';
                $response[$i]['team_name']=$captain->Team_Name;
            }
            else{
                 $event=DB::table('subevents')->where('Sub_Event_Id',$captain->Sub_Event_Id)->first();
                $response[$i]['event_Name']=$event->Name;
                $response[$i]['status']='UNPAID';
                $response[$i]['team_name']='---';
            }
        }

        foreach ($member as $mem) {
            $i++;
            $event=DB::table('subevents')->where('Sub_Event_Id',$mem->Sub_Event_Id)->first();
            $response[$i]['event_Name']=$event->Name;
            $response[$i]['status']='PAID';
            $response[$i]['team_name']=$mem->Team_Name;
            
        }        // echo json_encode($response);         die();

        return view('enrolledEvents')->with('response',$response);
     
    }

    public function pay_amount(Request $request){
        if(Auth::guest()){
           // echo "guest";
           return Redirect('/');
        }
        else{
            $input=$request->all();
            $sub_event_id=$input['sub_id'];
            $prim_detail=DB::table('studentprimdetail')->where('Uni_Roll_No',Auth::user()->email)->orWhere('Lib_Card_No',Auth::user()->email)->get();

            $lib=$prim_detail[0]->Lib_Card_No;
        
            $event_details=DB::table('subevents')->where('Sub_Event_Id',$sub_event_id)->get();
            $q_team=DB::table('ind_reg')->where('Sub_Event_Id',$sub_event_id)->where('Lib_Id','Like','%'.$lib.'%')->where('Paid_Status','N')->get();
            //echo json_encode($q_team);
            if(count($q_team)==0){
                //echo "00000000000";
                 return view('message')->with('message','Already Paid')->with('error',true);
               // return Redirect('/');
            }
            else{
                $lib_arr=explode(',', $q_team[0]->Lib_Id);
                //echo json_encode($lib_arr);
                $amount=$event_details[0]->Amount*count($lib_arr);

               Db::table('order_details')->insert(['Reg_Id'=>$q_team[0]->Reg_Id,'User_Id'=>$lib,'Amount'=>$amount]);
               $order_details=DB::table('order_details')->select('Id','Order_Id')->where('Reg_Id',$q_team[0]->Reg_Id)->where('User_Id',$lib)->where('Status','PENDING')->orderBy('Id','desc')->limit(1)->get();
             //  echo json_encode($order_details);
               if($order_details[0]->Order_Id!=NULL){
                // return Redirect('/error');
                  return view('message')->with('message','Error generating order...')->with('error',true);
               }
               else{
                   $order_id="ORDER".$order_details[0]->Id;
                    DB::table('order_details')->where('Id',$order_details[0]->Id)->update(['Order_Id'=>$order_id]);
                   // return view('paytm')->with('order_details',$order_details)->with('order_id',$order_id)->with('amount',$amount);
                    return view('pgRedirect')->with('ORDER_ID',$order_id)->with('CUST_ID','PRA'.Auth::user()->email)->with('INDUSTRY_TYPE_ID','PrivateEducation')->with('CHANNEL_ID','WEB')->with('TXN_AMOUNT',$amount)->with('config_url','http://localhst:8000/lib/config_paytm.php')->with('encdec_url','http://localhost:8000/lib/encdec_paytm.php');
               }
            }
        }
    }
    public function complete(Request $request){
            if(Auth::guest()) {
            return Redirect('/');
        }
        else{

            $prim_detail=DB::table('studentprimdetail')->where('Uni_Roll_No',Auth::user()->email)->orWhere('Lib_Card_No',Auth::user()->email)->get();
		// echo json_encode($prim_detail);
            $lib=$prim_detail[0]->Lib_Card_No;
        
            header("Pragma: no-cache");
            header("Cache-Control: no-cache");
            header("Expires: 0");
           // $user=Auth::user()->id;
            require_once("lib/config_paytm.php");
            require_once("lib/encdec_paytm.php");
            $paytmChecksum = "";
            $paramList = array();
            $isValidChecksum = "FALSE";
            
            if(!isset($_POST)){
            	return view('message')->with('message','error')->with('error',false);
            }
            $paramList = $_POST;
           // echo $paramList['ORDERID']." ".$lib;
            $q_order=DB::table('order_details')->where('Order_Id',$paramList['ORDERID'])->where('User_Id',$lib)->get();
            //var_dump($q_order[0]->Amount);
           // echo json_encode($q_order);
            $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
            $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
            if($isValidChecksum == "TRUE") {
                if ($_POST["STATUS"] == "TXN_SUCCESS") {
                    if($_POST['TXNAMOUNT']>=$q_order[0]->Amount){
                    
                    
                    	 $a="https://secure.paytm.in/oltp/HANDLER_INTERNAL/TXNSTATUS?JsonData={'MID':'MID','ORDERID':'".$paramList['ORDERID']."'}";
		            $contents = file_get_contents($a); 
		            $contents=json_decode($contents,true);
		            
		            
		            if($contents["TXNAMOUNT"]>=$q_order[0]->Amount && $contents['STATUS']=="TXN_SUCCESS" )
		            {   
	                       DB::table('order_details')->where('Order_Id',$q_order[0]->Order_Id)->update(['Status'=>'PAID']);
	                       $q_or=DB::table('order_details')->where('Order_Id',$q_order[0]->Order_Id)->select('Reg_Id')->get();
	                       DB::table('ind_reg')->where('Reg_Id',$q_or[0]->Reg_Id)->update(['Paid_Status'=>'Y']);
	                      return view('message')->with('message','Payment Successful')->with('error',false);
	                      
	                     }
	                     else{
	                     	return view('message')->with('message','Error4')->with('error',false);
	                     }
                    }
                    else{
                        return view('message')->with('message','Error1')->with('error',false);
                    }
                }
                else{
                    return view('message')->with('message','Error2')->with('error',false);
                }
            }
            else{
                return view('message')->with('message','Error3')->with('error',false);
            }
            
        }
    }

    public function contact_us(Request $request){
        return view('contact');
    }

     public function confirm_payment(){

        if(Auth::guest()){
            return Redirect('/');
        }
            $prim_detail=DB::table('studentprimdetail')->select('Lib_Card_No')->where('Uni_Roll_No',Auth::user()->email)->orWhere('Lib_Card_No',Auth::user()->email)->get();
            $lib=$prim_detail[0]->Lib_Card_No;

            $q_order=DB::table('order_details')->where('User_Id',$lib)->orderBy('Id','desc')->limit(1)->get();

            $a="https://secure.paytm.in/oltp/HANDLER_INTERNAL/TXNSTATUS?JsonData={'MID':'KriIns08204252501061','ORDERID':'".$q_order[0]->Order_Id."'}";
            $contents = file_get_contents($a); 
            $contents=json_decode($contents,true);
            if($contents["TXNAMOUNT"]==$q_order[0]->Amount && $contents["STATUS"]=='TXN_SUCCESS')
            {   
                 //echo json_encode($contents);
                DB::table('order_details')->where('Order_Id',$contents['ORDERID'])->update(['Status'=>'PAID']);
               
            }
    }

    public function coming_soon(){
        if(Auth::guest()){
            return Redirect('/');
        }
         return view('message')->with('message','Coming Soon...')->with('error',false);
    }

      public function not_found(){
        if(Auth::guest()){
            return Redirect('/');
        }
         return view('message')->with('message','404 NOT FOUND')->with('error',false);
    }
}
