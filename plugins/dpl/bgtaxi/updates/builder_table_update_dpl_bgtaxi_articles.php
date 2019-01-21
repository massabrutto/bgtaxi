<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiArticles extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_articles', function($table)
        {
            $table->boolean('active')->default(1);
            $table->integer('sort_order')->unsigned();
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_articles', function($table)
        {
            $table->dropColumn('active');
            $table->dropColumn('sort_order');
            $table->dropColumn('slug');
        });
    }
}
