<?php namespace Ovalsoft\Appointment\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateDayTimeTable extends Migration
{
    public function up()
    {
        Schema::create('ovalsoft_appointment_day_time', function (Blueprint $table) {
          $table->integer('day_id')->unsigned();
          $table->integer('time_id')->unsigned();
          $table->primary(['day_id', 'time_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ovalsoft_appointment_day_time');
    }
}
