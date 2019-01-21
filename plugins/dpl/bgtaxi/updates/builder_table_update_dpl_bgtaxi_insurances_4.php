<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiInsurances4 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_insurances', function($table)
        {
            $table->text('start_time_preview')->nullable();
            $table->text('start_time')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_insurances', function($table)
        {
            $table->dropColumn('start_time_preview');
            $table->string('start_time', 255)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
