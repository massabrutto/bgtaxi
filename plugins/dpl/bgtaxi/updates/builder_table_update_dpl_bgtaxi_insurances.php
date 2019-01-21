<?php namespace Dpl\Bgtaxi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateDplBgtaxiInsurances extends Migration
{
    public function up()
    {
        Schema::rename('dpl_bgtaxi_insurance', 'dpl_bgtaxi_insurances');
    }
    
    public function down()
    {
        Schema::rename('dpl_bgtaxi_insurances', 'dpl_bgtaxi_insurance');
    }
}
