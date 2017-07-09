<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('COMPANIES', function (Blueprint $table){
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->tinyInteger('subscription_id');
            $table->string('logo');
            $table->string('website');
            $table->string('contact_phone');
            $table->boolean('is_active');
            $table->boolean('is_confirmed');
            $table->boolean('is_deactivated');
            $table->boolean('is_referal');
            $table->timestamps();
        });
        
        Schema::create('EVENTTYPES', function (Blueprint $table){
            $table->increments('id');
            $table->integer('org_id')->unsigned();
            $table->foreign('org_id')->references('id')->on('COMPANIES');
            $table->string('name');
            $table->timestamps();
        });
            
        Schema::create('EVENTS', function (Blueprint $table){
            $table->increments('id')->unsigned();
            $table->integer('org_id')->unsigned();
            $table->foreign('org_id')->references('id')->on('COMPANIES');
            $table->string('title');
            $table->bigInteger('start');
            $table->bigInteger('end');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('EVENTTYPES');
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
        //
    }
}
