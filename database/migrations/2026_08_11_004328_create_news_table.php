<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('col_span')->default('col-span-1');
            $table->string('row_span')->default('row-span-1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};