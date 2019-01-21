<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDplBgtaxiTransfers extends Migration
{
    public function up()
    {
        Schema::create('dpl_bgtaxi_transfers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->string('link')->nullable();
            $table->string('link_text')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dpl_bgtaxi_transfers');
    }
}