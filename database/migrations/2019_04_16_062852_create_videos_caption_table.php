<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosCaptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos_caption', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->unsignedBigInteger('vid_id');
             $table->longText('caption_text');
             $table->float('time_sec');
             $table->float('duration');
          
        });


        Schema::table('videos_caption', function($table){
              $table->foreign('vid_id')->references('id')->on('videos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos_caption');

          Schema::table('videos_caption', function(Blueprint $table) {
            $table->dropForeign('videos_caption_vid_id_foreign');
        });
    }
}
