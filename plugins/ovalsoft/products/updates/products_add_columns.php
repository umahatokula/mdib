<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ProductsAddColumns extends Migration
{

    public function up()
    {
        Schema::table('lovata_shopaholic_products', function($table)
        {
            $table->boolean('is_digital')->default(0)->nullable();
            $table->string('product_link')->nullable();
        });
    }

    public function down()
    {
      if (Schema::hasColumn('lovata_shopaholic_products', 'is_digital')) {
          Schema::table('lovata_shopaholic_products', function($table)
          {
              $table->dropColumn('is_digital');
          });
      }
      if (Schema::hasColumn('lovata_shopaholic_products', 'product_link')) {
          Schema::table('lovata_shopaholic_products', function($table)
          {
              $table->dropColumn('product_link');
          });
      }
    }

}
