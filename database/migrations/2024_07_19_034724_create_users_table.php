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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key.
            $table->string('username'); // Username column.
            $table->string('password'); // Password column.
            $table->unsignedBigInteger('admin_id')->nullable(); // Foreign key to admin.
            $table->unsignedBigInteger('client_id')->nullable(); // Foreign key to client.
            $table->unsignedBigInteger('staff_id')->nullable(); // Foreign key to staff.
            $table->unsignedBigInteger('created_by')->nullable(); // Foreign key for created by.
            $table->timestamp('created_on')->nullable(); // Timestamp for creation.
            $table->unsignedBigInteger('updated_by')->nullable(); // Foreign key for updated by.
            $table->timestamp('updated_on')->nullable(); // Timestamp for update.
            $table->unsignedBigInteger('deleted_by')->nullable(); // Foreign key for deleted by.
            $table->timestamp('deleted_on')->nullable(); // Timestamp for deletion.
            $table->boolean('deleted_status')->default(false); // Boolean status for deletion.
            $table->timestamp('last_updated')->nullable(); // Timestamp for last updated.

            // Optionally add foreign key constraints
            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
