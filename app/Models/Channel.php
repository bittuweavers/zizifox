<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
   

	 public function video()
    {
        return $this->hasMany(\App\Models\Video::class);
    }
	    	
    	public static function get_channel_name($values){
    	//print_r(explode(',',$values));die;
		$_this = new self;
		$channel_name_data = $_this->whereIn('id', explode(',',$values))->pluck('channel_name')->toArray();
	
		if($channel_name_data){
			$channel_name = implode(',', $channel_name_data);
		}else{
			$channel_name ="";
		}
		return $channel_name;
		
	}
	public static function get_channel_name_by_id($id){
    	//print_r(explode(',',$values));die;
		$_this = new self;
		$channel_name_data = $_this->where('id',$id)->first();
		
		if(is_object($channel_name_data) && ($channel_name_data instanceof Model)){
			$channel_name = $channel_name_data->channel_name;
		}else{
			$channel_name ="";
		}
		return $channel_name;
		
	}

	
}
