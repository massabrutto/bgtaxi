<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiExcursions5 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->string('seo_item_title');
            $table->string('seo_item_description');
            $table->string('seo_item_keywords');
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->dropColumn('seo_item_title');
            $table->dropColumn('seo_item_description');
            $table->dropColumn('seo_item_keywords');
        });
    }
}
