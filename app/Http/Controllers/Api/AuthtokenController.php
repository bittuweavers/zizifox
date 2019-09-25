<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\JsonApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Settings;


class AuthtokenController extends Controller
{
	use JsonApiResponseHelper;
	public function gettoken(){
			$settings = new Settings();
        $api_status =  $settings->getSettings('api-status');
         if($api_status =='1'){
         	  $api_token =  $settings->getSettings('api-token');
         	   return response()->json(['isError' => 0,'errorCode' => 0,'token' => $api_token], 200);

         	}else{
   			return response()->json(['isError' => 1,'errorCode' => 404,'message' => "Api is disable"], 200);
   		}

	}


	
}
