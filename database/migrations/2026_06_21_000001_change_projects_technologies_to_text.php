<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Convert technologies from JSON to plain text so users can list
     * technologies freely (e.g. "Laravel, Vue, MySQL") without JSON errors.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('technologies')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->json('technologies')->nullable()->change();
        });
    }
};
