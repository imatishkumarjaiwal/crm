<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrnJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trn_jobs', function (Blueprint $table) {
            $table->increments('job_id');
            $table->date('job_date')->nullable();
            $table->string('job_received_from', 100)->nullable();
            $table->integer('job_client_id')->nullable();
            $table->string('job_client_contact_person', 500)->nullable();
            $table->integer('job_staff_id')->nullable();
            $table->text('job_property_details')->nullable();
            $table->text('job_instructions')->nullable();
            $table->string('job_file_type', 200)->nullable();
            $table->string('job_fileno', 300)->nullable();
            $table->string('job_file_return_status', 200)->nullable();
            $table->text('job_file_return_reason')->nullable();
            $table->date('job_file_return_date')->nullable();
            $table->integer('job_ref_fileno')->nullable();
            $table->string('job_doclist_names', 200)->nullable();
            $table->integer('job_advocate_fee')->nullable();
            $table->integer('job_stamp_reg_court_fee')->nullable();
            $table->integer('job_misc_expenses')->nullable();
            $table->integer('job_total_amount')->nullable();
            $table->integer('job_total_receipt')->nullable();
            $table->integer('job_total_payment')->nullable();
            $table->integer('job_discount')->nullable();
            $table->integer('job_settled_amount')->nullable();
            $table->dateTime('job_createdon')->nullable();
            $table->integer('job_createdby')->nullable();
            $table->dateTime('job_updatedon')->nullable();
            $table->integer('job_updatedby')->nullable();
            $table->string('job_deleted', 1)->default('N')->nullable();
            $table->dateTime('job_deletedon')->nullable();
            $table->integer('job_deletedby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trn_jobs');
    }
}
