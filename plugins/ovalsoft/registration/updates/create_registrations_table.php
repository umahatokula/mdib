<?php namespace Ovalsoft\Registration\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('ovalsoft_registration_registrations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('relationship_status');
            $table->string('event');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ovalsoft_registration_registrations');
    }
}
