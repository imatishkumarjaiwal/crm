<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstParamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_param', function (Blueprint $table) {
            $table->integer('site_id')->primary();
            $table->string('site_name', 50)->nullable();
            $table->integer('site_currency_id')->nullable();
            $table->string('site_email', 50)->nullable();
            $table->text('site_address')->nullable();
            $table->string('site_phone', 100)->nullable();
            $table->text('site_llno')->nullable();
            $table->text('site_legal_email')->nullable();
            $table->text('site_main_website')->nullable();
            $table->string('site_fax', 100)->nullable();
            $table->string('site_url', 100)->nullable();
            $table->string('site_incharge', 100)->nullable();
            $table->string('site_logo', 100)->nullable();
            $table->float('site_tax_rate')->nullable();
            $table->float('site_add_time_hh_mm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_param');
    }
}
