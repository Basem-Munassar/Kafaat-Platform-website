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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_available')->default(true)->after('role');
            // Note: Since role is enum('user', 'admin', 'super admin'), 
            // modifying enum in older Laravel was hard, but in newer Laravel we can just drop and recreate or use a string
            // We will just change it to a string column so it can accept 'employee' and 'user'.
            // However, sqlite doesn't support changing column types natively without drop.
            // We will just add a string column 'account_type' to be safe for sqlite/mysql compatibility.
            $table->string('account_type')->default('user')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_available');
            $table->dropColumn('account_type');
        });
    }
};
