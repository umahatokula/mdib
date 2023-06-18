<?php namespace Ovalsoft\Appointment\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTimesTable extends Migration
{
    public function up()
    {
        Schema::create('ovalsoft_appointment_times', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('start_time_of_day');
            $table->string('end_time_of_day');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ovalsoft_appointment_times');
    }
}
