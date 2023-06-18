<?php namespace Ovalsoft\Appointment\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTypesTable extends Migration
{
    public function up()
    {
        Schema::create('ovalsoft_appointment_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->double('amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ovalsoft_appointment_types');
    }
}
