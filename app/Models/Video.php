<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    
 	 /**
     * The lessons associated with the module.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function captions()
    {
      return $this->hasMany(\App\Models\VideosCaption::class,'vid_id');
    } 
     public function channels()
    {
        return $this->belongsTo(\App\Models\Channel::class);
    }
}
