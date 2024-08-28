<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_currency', function (Blueprint $table) {
            $table->id('currency_id');
            $table->string('currency_name', 100)->nullable();
            $table->string('currency_code', 10)->nullable();
            $table->string('currency_symbol', 10)->nullable();
            $table->dateTime('currency_createdon')->nullable();
            $table->unsignedBigInteger('currency_createdby')->nullable();
            $table->dateTime('currency_updatedon')->nullable();
            $table->unsignedBigInteger('currency_updatedby')->nullable();
            $table->char('currency_deleted', 1)->default('N');
            $table->dateTime('currency_deletedon')->nullable();
            $table->unsignedBigInteger('currency_deletedby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_currency');
    }
}
