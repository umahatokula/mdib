<?php namespace Ovalsoft\Payment\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateOvalsoftPayment extends Migration
{
    public function up()
    {
        Schema::create('ovalsoft_payments_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('reference', 255)->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('amount')->nullable();
            $table->string('order_number')->nullable();
            $table->string('message')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ovalsoft_payment_');
    }
}
