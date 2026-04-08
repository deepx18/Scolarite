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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique()->comment('REQ-YYYY-XXX format');
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('type')->comment('transfer, withdrawal, transcript, etc.');
            $table->string('status')->default('pending')->comment('pending, in_review, approved, rejected, archived');
            $table->text('comment')->nullable();
            $table->json('details')->nullable()->comment('Type-specific fields stored as JSON');
            $table->date('submitted_at')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
