<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiTransfers2 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_transfers', function($table)
        {
            $table->text('description')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_transfers', function($table)
        {
            $table->string('description', 255)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
