<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car');
            $table->integer('driver');
            $table->integer('num_of_car');
            $table->string('starting_point', 500);
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->integer('num_date');
            $table->string('target', 500);
            $table->string('objectives', 500);
            $table->string('province_code', 2);
            $table->string('summary', 100);
            $table->integer('status');
            $table->integer('creator');
            $table->integer('approvers');
            $table->dateTime('approved_when');
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
        Schema::dropIfExists('task');
    }
}
