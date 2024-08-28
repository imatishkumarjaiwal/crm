<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_staff', function (Blueprint $table) {
            $table->increments('staff_id');
            $table->string('staff_salutation', 100)->nullable();
            $table->string('staff_first_name', 100)->nullable();
            $table->string('staff_middle_name', 100)->nullable();
            $table->string('staff_last_name', 100)->nullable();
            $table->text('staff_address')->nullable();
            $table->string('staff_city', 100)->nullable();
            $table->string('staff_pin', 10)->nullable();
            $table->string('staff_state', 100)->default('Maharashtra')->nullable();
            $table->string('staff_country', 100)->default('India')->nullable();
            $table->string('staff_mobile', 11)->nullable();
            $table->string('staff_email', 100)->nullable();
            $table->string('staff_mobile_1', 11)->nullable();
            $table->string('staff_email_1', 100)->nullable();
            $table->string('staff_photo', 100)->nullable();
            $table->string('staff_aadhar', 20)->nullable();
            $table->text('staff_aadhar_file')->nullable();
            $table->text('staff_pan_file')->nullable();
            $table->string('staff_pan', 20)->nullable();
            $table->date('staff_dob')->nullable();
            $table->date('staff_doj')->nullable();
            $table->date('staff_dol')->nullable();
            $table->string('staff_user_role', 100)->default('User');
            $table->string('staff_designation', 100)->nullable();
            $table->integer('staff_salary')->nullable();
            $table->text('staff_salary_increment_note')->nullable();
            $table->string('staff_password', 20)->default('12345');
            $table->string('staff_status', 10)->default('Active');
            $table->text('staff_bank')->nullable();
            $table->text('staff_account_number')->nullable();
            $table->text('staff_ifsc_code')->nullable();
            $table->string('staff_ref_name_1', 100)->nullable();
            $table->string('staff_ref_relation_1', 20)->nullable();
            $table->string('staff_ref_mobile_1', 11)->nullable();
            $table->string('staff_ref_name_2', 100)->nullable();
            $table->string('staff_ref_relation_2', 20)->nullable();
            $table->string('staff_ref_mobile_2', 11)->nullable();
            $table->string('staff_ref_name_3', 100)->nullable();
            $table->string('staff_ref_relation_3', 20)->nullable();
            $table->string('staff_ref_mobile_3', 11)->nullable();
            $table->string('staff_ref_name_4', 100)->nullable();
            $table->string('staff_ref_relation_4', 20)->nullable();
            $table->string('staff_ref_mobile_4', 11)->nullable();
            $table->string('staff_ref_name_5', 100)->nullable();
            $table->string('staff_ref_relation_5', 20)->nullable();
            $table->string('staff_ref_mobile_5', 11)->nullable();
            $table->integer('staff_createdby')->nullable();
            $table->timestamp('staff_createdon')->nullable();
            $table->integer('staff_updatedby')->nullable();
            $table->dateTime('staff_updatedon')->nullable();
            $table->string('staff_deleted', 1)->default('N');
            $table->integer('staff_deletedby')->nullable();
            $table->dateTime('staff_deletedon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_staff');
    }
}
