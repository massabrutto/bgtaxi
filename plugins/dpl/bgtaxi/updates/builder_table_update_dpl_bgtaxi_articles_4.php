<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiArticles4 extends Migration
{
    public function up()
    {
        Schema::table('dpl_bgtaxi_articles', function($table)
        {
            $table->text('preview_description')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('dpl_bgtaxi_articles', function($table)
        {
            $table->string('preview_description', 255)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
