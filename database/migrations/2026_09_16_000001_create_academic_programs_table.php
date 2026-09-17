<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Teknik Informatika"
            $table->string('slug')->unique();
            $table->enum('degree', ['D3', 'S1', 'S2', 'S3'])->default('S1');
            $table->string('faculty'); // e.g. "Fakultas Ilmu Komputer"
            $table->string('accreditation')->default('Unggul'); // Unggul, A, Baik Sekali
            $table->text('description')->nullable();
            $table->text('career_prospects')->nullable(); // JSON or text list of careers
            $table->string('duration_years')->default('4 Tahun (8 Semester)');
            $table->string('tuition_fee')->nullable(); // e.g. "Rp 7.500.000 / semester"
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_programs');
    }
};
