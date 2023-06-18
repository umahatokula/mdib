<?php namespace Ovalsoft\Appointment\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCounsellingQuestionnairesTable extends Migration
{
    public function up()
    {
        Schema::create('ovalsoft_appointment_counselling_questionnaires', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->json('hope_to_achieve')->nullable();
            $table->string('gender')->nullable();
            $table->string('counsellor_type')->nullable();
            $table->string('violence_issues')->nullable();
            $table->string('financial_status')->nullable();
            $table->integer('age')->nullable();
            $table->string('marriage_duration')->nullable();
            $table->string('children')->nullable();
            $table->json('hear_about_us')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('dob')->nullable();
            $table->string('r_status')->nullable();
            $table->string('occupation')->nullable();
            $table->string('educational_background')->nullable();
            $table->string('position_in_family')->nullable();
            $table->string('married_before')->nullable();
            $table->string('have_children')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ovalsoft_appointment_marital_counselling_questionnaires');
    }
}
