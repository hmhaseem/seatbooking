<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_id');
            
            // A label like A1, B2, etc. 
            $table->string('seat_label')->nullable();

            // For optional row/column tracking
            $table->integer('row_number')->nullable();
            $table->integer('column_number')->nullable();

            // E.g. 'available', 'processing', 'booked' (set a default if you want)
            $table->string('status')->default('available'); 
            
            $table->timestamps();

            // Foreign key to link seat -> bus
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
