<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('provider')->nullable();
            $table->enum('coverage_type', ['full', 'partial', 'living_allowance'])->default('partial');
            $table->string('amount')->nullable();
            $table->date('deadline')->nullable();
            $table->text('description')->nullable();
            $table->longText('requirements')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
