<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiExcursions3 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->string('preview_price', 255)->nullable();
            $table->string('preview_price_2', 255)->nullable();
            $table->dropColumn('previe_price');
            $table->dropColumn('previe_price_2');
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->dropColumn('preview_price');
            $table->dropColumn('preview_price_2');
            $table->string('previe_price', 255)->nullable();
            $table->string('previe_price_2', 255)->nullable();
        });
    }
}
