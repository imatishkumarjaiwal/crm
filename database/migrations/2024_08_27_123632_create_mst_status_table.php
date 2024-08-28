<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_status', function (Blueprint $table) {
            $table->increments('status_id');
            $table->string('status_name', 100)->nullable();
            $table->string('status_color', 10)->default('#ffffff');
            $table->text('status_desc')->nullable();
            $table->integer('status_createdby')->nullable();
            $table->timestamp('status_createdon')->nullable();
            $table->integer('status_updatedby')->nullable();
            $table->dateTime('status_updatedon')->nullable();
            $table->string('status_deleted', 1)->default('N');
            $table->integer('status_deletedby')->nullable();
            $table->dateTime('status_deletedon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_status');
    }
}
