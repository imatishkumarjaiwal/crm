<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('salutation')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('date_of_birth')->nullable();
            $table->string('mobile_number')->unique();
            $table->string('email')->unique();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->text('address')->nullable();
            $table->string('aadhar_number')->nullable();
            $table->string('aadhar_file')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('pan_file')->nullable();
            $table->string('designation')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->date('date_of_leaving')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->text('salary_increment_note')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('created_on')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('updated_on')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamp('deleted_on')->nullable();
            $table->boolean('deleted_status')->default(false);
            $table->timestamp('last_updated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
