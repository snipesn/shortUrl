<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShortUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_url', function (Blueprint $table){
            $table->id();
            $table->string('source');
            $table->string('short');
            $table->dateTime('active_to');
            $table->bigInteger('count_redirects');
            
            $table->unique('short');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('short_url');
    }
}
