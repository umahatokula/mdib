<?php namespace Ovalsoft\Appointment\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateDayBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('ovalsoft_appointment_bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('code')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ovalsoft_appointment_bookings');
    }
}
