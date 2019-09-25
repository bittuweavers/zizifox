<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Settings;
use Illuminate\Support\Facades\Input;

class AdminSettingsController extends Controller
{
    public function saveSettings(Request $request){
		
		$requests = $request->all();
		$meta_key = $requests['key'];
		$meta_value = $requests['value'];
		Settings::saveSettings($meta_key,$meta_value);
		
		return response()->json(['response' => 'done']); 
		
	}
	
	public function settingsOption(){
		return \View::make('admin.settings.settings', []);
	}
	
	public function saveOrUpdateSettings(Request $request){
		$settings = $request->settings;
	
		if(isset($settings['api-status']) &&  ($settings['api-status'] == 'on')){
			$settings['api-status'] = 1;
		}else{
			$settings['api-status'] = 0;
		}
	
		foreach($settings as $meta_key => $meta_value){
			Settings::saveSettings($meta_key,$meta_value);
		}
		
		return Redirect::to('/admin/settings');
	}
	
}
