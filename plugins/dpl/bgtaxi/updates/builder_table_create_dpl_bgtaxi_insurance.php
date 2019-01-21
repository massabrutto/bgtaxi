<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDplBgtaxiInsurance extends Migration
{
    public function up()
    {
        Schema::create('dpl_bgtaxi_insurance', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('preview_title')->nullable();
            $table->string('start_time')->nullable();
            $table->string('finish_time')->nullable();
            $table->string('previe_price')->nullable();
            $table->string('previe_price_2')->nullable();
            $table->string('price')->nullable();
            $table->text('description')->nullable();
            $table->string('title')->nullable();
            $table->string('preview_description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dpl_bgtaxi_insurance');
    }
}