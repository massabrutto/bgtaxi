<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiExcursions6 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->string('seo_item_title')->nullable()->change();
            $table->string('seo_item_description')->nullable()->change();
            $table->string('seo_item_keywords')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_excursions', function($table)
        {
            $table->string('seo_item_title', 255)->nullable(false)->change();
            $table->string('seo_item_description', 255)->nullable(false)->change();
            $table->string('seo_item_keywords', 255)->nullable(false)->change();
        });
    }
}
