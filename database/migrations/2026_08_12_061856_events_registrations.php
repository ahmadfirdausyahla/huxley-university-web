<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('event_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('type', ['public', 'student']);

            $table->string('name');

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->string('institution')->nullable();

            $table->string('nim')->nullable();

            $table->string('campus_email')->nullable();

            $table->string('study_program')->nullable();

            $table->string('faculty')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};