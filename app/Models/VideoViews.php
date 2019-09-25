<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class VideoViews extends Model
{
    //
       public $timestamps = false;

       public function getVideoViewCount($video_id){
       	 $video_view_count = VideoViews::where('video_id',$video_id)->count(); 
       	 return $video_view_count;
       }

       public function getcountvideoview($video_id){
       $ip_id=Session::get('ip_id');
       $video_view_count = VideoViews::where('ip_add_id',$ip_id)->where('video_id',$video_id)->count(); 
       	 return $video_view_count;
       }
  		public function saveviewvideo($video_id){
       $ip_id=Session::get('ip_id');
        $video_views = new VideoViews;
               $video_views->ip_add_id =$ip_id;
               $video_views->video_id =$video_id; 
                $video_views->view ='1';
                $save_view = $video_views->save();
                return $save_view;
        }        
}
