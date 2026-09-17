<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->text('features')->nullable()->after('capacity');
        });

        DB::statement("ALTER TABLE facilities MODIFY COLUMN category VARCHAR(50) DEFAULT 'lainnya'");
    }

    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn('features');
        });
    }
};
