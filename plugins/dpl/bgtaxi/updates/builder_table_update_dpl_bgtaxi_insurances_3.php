<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiInsurances3 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_insurances', function($table)
        {
            $table->boolean('active')->nullable(false)->change();
            $table->string('slug')->nullable(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_insurances', function($table)
        {
            $table->boolean('active')->nullable()->change();
            $table->string('slug', 255)->nullable()->change();
        });
    }
}
