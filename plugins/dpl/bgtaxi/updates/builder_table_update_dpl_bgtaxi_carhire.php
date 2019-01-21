<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiCarhire extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_carhire', function($table)
        {
            $table->boolean('active')->default(1);
            $table->string('sort_order');
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_carhire', function($table)
        {
            $table->dropColumn('active');
            $table->dropColumn('sort_order');
            $table->dropColumn('slug');
        });
    }
}
