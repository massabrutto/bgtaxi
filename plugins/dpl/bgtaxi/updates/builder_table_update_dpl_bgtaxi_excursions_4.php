<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiExcursions4 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->renameColumn('start_date_time', 'start_time_preview');
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->renameColumn('start_time_preview', 'start_date_time');
        });
    }
}
