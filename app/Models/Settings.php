<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
   /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'settings';
	
	public $timestamps = false;
	
	
	/**
	 * Save value to database
	 *
	 */
	public static function saveSettings($key,$value){
		$_this = new self;
		$setting = $_this->where('meta_key', $key)->first();
		if(is_object($setting) && ($setting instanceof Model)){
			$setting->meta_value = $value;
			$setting->save();
		}else{
			
			$_this->meta_key = $key;
			$_this->meta_value = $value;
			$_this->save();
		}
		return true;
	}
	
	
	/**
	 * get settings
	 *
	 * return saved setting
	 */
	public static function getSettings($key){
		$_this = new self;
		$setting = $_this->where('meta_key', $key)->first();
		if(is_object($setting) && ($setting instanceof Model)){
			return $setting->meta_value;
		}else{
			return false;
		}
	}
	
}
