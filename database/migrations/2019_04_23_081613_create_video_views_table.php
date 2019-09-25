<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_views', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ip_add_id');
            $table->unsignedBigInteger('video_id');
            $table->boolean('view');
        });

        Schema::table('video_views', function($table){
              $table->foreign('ip_add_id')->references('id')->on('ip_address')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('video_views', function($table){
              $table->foreign('video_id')->references('id')->on('videos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_views');
        Schema::table('video_views', function(Blueprint $table) {
            $table->dropForeign('video_views_ip_add_id_foreign');
            $table->dropForeign('video_views_video_id_foreign');
        });
    }
}
