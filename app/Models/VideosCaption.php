<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideosCaption extends Model
{
	  // protected $table = 'videos_caption';
	   public $timestamps = false;

	   public function getallvideocaption($video_id){
	   	 $videos_caption = VideosCaption::where('vid_id',$video_id )->get();
       	 return $videos_caption;
       }

        /**
	     * The account associated with the user.
	     *
	     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	     */
	    public function video()
	    {
	        return $this->belongsTo(\App\Models\Video::class);
	    }

    //
}
