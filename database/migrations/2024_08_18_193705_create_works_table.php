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
        Schema::create('works', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key.
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('created_by')->nullable(); // Foreign key for created by.
            $table->timestamp('created_on')->nullable(); // Timestamp for creation.
            $table->unsignedBigInteger('updated_by')->nullable(); // Foreign key for updated by.
            $table->timestamp('updated_on')->nullable(); // Timestamp for update.
            $table->unsignedBigInteger('deleted_by')->nullable(); // Foreign key for deleted by.
            $table->timestamp('deleted_on')->nullable(); // Timestamp for deletion.
            $table->boolean('deleted_status')->default(false); // Boolean status for deletion.
            $table->timestamp('last_updated')->nullable(); // Timestamp for last updated.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
