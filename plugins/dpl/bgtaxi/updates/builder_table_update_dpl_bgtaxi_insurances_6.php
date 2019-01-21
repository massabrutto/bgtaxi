<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiInsurances6 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_insurances', function($table)
        {
            $table->string('seo_item_title')->nullable();
            $table->string('seo_item_description')->nullable();
            $table->string('seo_item_keywords')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_insurances', function($table)
        {
            $table->dropColumn('seo_item_title');
            $table->dropColumn('seo_item_description');
            $table->dropColumn('seo_item_keywords');
        });
    }
}
