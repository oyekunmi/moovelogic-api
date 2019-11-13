<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('current_location');
            $table->string('start_location');
            $table->string('end_location');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('cost_of_trip');
            $table->enum('trip_status',['IN_PROGRESS', 'DELIVERED','PENDING', 'ENDED','CANCELLED']);
            $table->string('recipient_name');
            $table->string('recipient_phone_number');
            $table->unsignedBigInteger('rider_id');
            $table->timestamps();

    
            $table->foreign('rider_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
