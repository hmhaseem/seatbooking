<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
        $table->id();
        $table->string('bus_name')->nullable();
        $table->string('origin')->nullable();
        $table->string('destination')->nullable();
        $table->dateTime('departure_time')->nullable();
        $table->dateTime('arrival_time')->nullable();
        $table->string('bus_type')->nullable();  // e.g. Normal, AC, Luxury, etc.
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
        Schema::dropIfExists('buses');
    }
}
