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
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id'); // Foreign key for staff
            $table->string('name');
            $table->string('relationship');
            $table->string('mobile');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('created_on')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('updated_on')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamp('deleted_on')->nullable();
            $table->boolean('deleted_status')->default(false);
            $table->timestamp('last_updated')->nullable();
            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('references');
    }
};
