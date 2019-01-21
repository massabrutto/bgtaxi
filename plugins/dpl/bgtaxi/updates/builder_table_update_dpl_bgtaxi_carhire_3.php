<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiCarhire3 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_carhire', function($table)
        {
            $table->text('link_text')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_carhire', function($table)
        {
            $table->string('link_text', 255)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
