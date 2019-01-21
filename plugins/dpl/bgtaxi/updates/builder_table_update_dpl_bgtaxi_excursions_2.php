<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiExcursions2 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->text('start_date_time')->nullable();
            $table->text('start_time')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->dropColumn('start_date_time');
            $table->string('start_time', 255)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
