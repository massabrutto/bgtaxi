<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDplBgtaxiCarhire extends Migration
{
    public function up()
    {
        Schema::create('dpl_bgtaxi_carhire', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('model')->nullable();
            $table->string('reg_num')->nullable();
            $table->text('details')->nullable();
            $table->text('icons')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dpl_bgtaxi_carhire');
    }
}