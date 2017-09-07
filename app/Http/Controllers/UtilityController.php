<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use App\User;


class UtilityController extends Controller
{
	
      public function contact_us(Request $request){
        return view('contact');
    }

      public function core_comittee(){
            $Test= DB::table('core_commitee')->get();
            //echo json_encode($Test);
            return view('core_comittee')->with('det', $Test);
    }

}