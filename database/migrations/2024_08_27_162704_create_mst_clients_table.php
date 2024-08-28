<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_clients', function (Blueprint $table) {
            $table->increments('client_id');
            $table->string('client_firm_name', 100)->nullable();
            $table->string('client_salutation', 100)->nullable();
            $table->string('client_first_name', 100)->nullable();
            $table->string('client_middle_name', 100)->nullable();
            $table->string('client_last_name', 100)->nullable();
            $table->text('client_address')->nullable();
            $table->string('client_city', 100)->nullable();
            $table->string('client_pin', 10)->nullable();
            $table->string('client_state', 100)->default('Maharashtra')->nullable();
            $table->string('client_country', 100)->default('India')->nullable();
            $table->string('client_mobile', 11)->nullable();
            $table->string('client_email', 100)->nullable();
            $table->string('client_mobile_1', 11)->nullable();
            $table->string('client_email_1', 100)->nullable();
            $table->string('client_website', 100)->nullable();
            $table->string('client_contact_person', 100)->nullable();
            $table->string('client_contact_desig', 100)->nullable();
            $table->string('client_contact_mobile', 11)->nullable();
            $table->string('client_contact_email', 100)->nullable();
            $table->string('client_contact_person_1', 100)->nullable();
            $table->string('client_contact_desig_1', 100)->nullable();
            $table->string('client_contact_mobile_1', 11)->nullable();
            $table->string('client_contact_email_1', 100)->nullable();
            $table->string('client_contact_person_2', 100)->nullable();
            $table->string('client_contact_desig_2', 100)->nullable();
            $table->string('client_contact_mobile_2', 11)->nullable();
            $table->string('client_contact_email_2', 100)->nullable();
            $table->string('client_contact_person_3', 100)->nullable();
            $table->string('client_contact_desig_3', 100)->nullable();
            $table->string('client_contact_mobile_3', 11)->nullable();
            $table->string('client_contact_email_3', 100)->nullable();
            $table->string('client_contact_person_4', 100)->nullable();
            $table->string('client_contact_desig_4', 100)->nullable();
            $table->string('client_contact_mobile_4', 11)->nullable();
            $table->string('client_contact_email_4', 100)->nullable();
            $table->date('client_start_date')->nullable();
            $table->string('client_refer_by', 500)->nullable();
            $table->text('client_sugg_for_prev_client',500)->nullable();
            $table->string('client_password', 20)->default('12345')->nullable();
            $table->string('client_user_role', 100)->default('Client')->nullable();
            $table->string('client_status', 10)->default('Active')->nullable();
            $table->text('client_remark')->nullable();
            $table->integer('client_createdby')->nullable();
            $table->timestamp('client_createdon')->nullable();
            $table->integer('client_updatedby')->nullable();
            $table->dateTime('client_updatedon')->nullable();
            $table->string('client_deleted', 1)->default('N')->nullable();
            $table->integer('client_deletedby')->nullable();
            $table->dateTime('client_deletedon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_clients');
    }
}
