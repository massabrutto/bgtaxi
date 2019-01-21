<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiCarhire2 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_carhire', function($table)
        {
            $table->string('link')->nullable();
            $table->string('link_text')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_carhire', function($table)
        {
            $table->dropColumn('link');
            $table->dropColumn('link_text');
        });
    }
}
