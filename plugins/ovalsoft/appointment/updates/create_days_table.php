<?php namespace Ovalsoft\Appointment\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateDaysTable extends Migration
{
    public function up()
    {
        Schema::create('ovalsoft_appointment_days', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('day_of_week');
            $table->integer('type_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ovalsoft_appointment_days');
    }
}
