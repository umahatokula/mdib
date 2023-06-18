<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UserGroupsAddColumns extends Migration
{

    public function up()
    {
        Schema::table('user_groups', function($table)
        {
            $table->double('amount', 15,2)->default(0.00)->nullable();
        });
    }

    public function down()
    {
      if (Schema::hasColumn('user_groups', 'amount')) {
          Schema::table('user_groups', function($table)
          {
              $table->dropColumn('amount');
          });
      }
    }

}
