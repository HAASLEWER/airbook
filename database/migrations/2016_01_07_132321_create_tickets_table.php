<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticketref', 255)->unique();
            $table->string('airline', 255);
            $table->dateTime('dateofdeparture');
            $table->string('class');
            $table->string('origin', 255);
            $table->string('destination', 255);
            $table->boolean('roundtrip')->nullable();
	    $table->dateTime('dateofreturn');
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
        Schema::drop('tickets');
    }
}
