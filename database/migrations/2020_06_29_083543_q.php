<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Q extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads',function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger("userId")->unsigned();
            $table->foreign("userId")->references('id')->on('users')->onDelete('cascade');
            $table->string("carBrand");
            $table->string("carModel");
            $table->float("carEngine");
            $table->integer("ownersCount");
            $table->integer("milage");
            $table->string("region");
            $table->string("city");
            $table->timestamps();
        });
        Schema::create('adImages',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string("name");
            $table->integer('adId')->unsigned();
            $table->foreign("adId")->references('id')->on('Ads')->onDelete('cascade');
   //  $table->binary("img")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("users");
        Schema::dropIfExists("ads");
        Schema::dropIfExists("adImages");
    }
}
