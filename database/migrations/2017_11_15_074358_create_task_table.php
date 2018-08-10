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
            $table->integer('car')->nullable();
            $table->integer('driver')->nullable();
            $table->integer('num_of_car')->nullable();

            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->integer('num_date');

            $table->string('target', 500);
            $table->string('objectives', 500);
            $table->string('province_code', 2);
            $table->string('summary', 100)->nullable();

            $table->integer('num_of_companion');
            $table->text('companion');
            $table->string('baggage', 300);
            $table->string('starting_point', 500);

            $table->integer('status');
            $table->integer('creator');
            $table->integer('thinker')->nullable();
            $table->dateTime('result_when')->nullable();
            $table->string('result_comment', 200);
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
