<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarship_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scholarship_id')->constrained('scholarships')->cascadeOnDelete();
            $table->string('applicant_type')->default('student'); // student, prospective_student, general
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('nim')->nullable();
            $table->string('current_institution')->nullable();
            $table->string('study_program')->nullable();
            $table->integer('semester')->nullable();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->text('achievements')->nullable();
            $table->text('motivation_letter')->nullable();
            $table->string('document_url')->nullable(); // Link portfolio / Google Drive berkas
            $table->string('status')->default('pending'); // pending, under_review, approved, rejected
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarship_applications');
    }
};
