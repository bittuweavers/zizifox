<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_result', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ip_add_id');
            $table->longText('search_text');
            $table->dateTime('search_date');
            $table->boolean('search_found_status');
           
        });


         Schema::table('search_result', function($table){
              $table->foreign('ip_add_id')->references('id')->on('ip_address')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_result');
        Schema::table('search_result', function(Blueprint $table) {
            $table->dropForeign('search_result_ip_add_id_foreign');
        });
    }
}
