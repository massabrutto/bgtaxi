<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiInsurances2 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_insurances', function($table)
        {
            $table->boolean('active')->nullable()->default(1);
            $table->integer('sort_order')->unsigned();
            $table->string('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_insurances', function($table)
        {
            $table->dropColumn('active');
            $table->dropColumn('sort_order');
            $table->dropColumn('slug');
        });
    }
}
