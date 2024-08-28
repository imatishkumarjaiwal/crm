<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_works', function (Blueprint $table) 
        {
            $table->increments('work_id'); // Primary key with auto-increment
            $table->string('work_name', 100)->nullable()->collation('utf8_unicode_ci'); // VARCHAR(100) and nullable
            $table->text('work_desc')->nullable()->collation('utf8_unicode_ci'); // TEXT and nullable
            $table->integer('work_createdby')->nullable(); // Integer and nullable
            $table->timestamp('work_createdon')->nullable(); // TIMESTAMP and nullable
            $table->integer('work_updatedby')->nullable(); // Integer and nullable
            $table->dateTime('work_updatedon')->nullable(); // DATETIME and nullable
            $table->string('work_deleted', 1)->default('N')->collation('utf8_unicode_ci'); // VARCHAR(1) with default value 'N'
            $table->integer('work_deletedby')->nullable(); // Integer and nullable
            $table->dateTime('work_deletedon')->nullable(); // DATETIME and nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_works');
    }
}
