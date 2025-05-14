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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // إضافة عمود user_id
            $table->string('name');
            $table->string('issuer');
            $table->date('issue_date')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();

            // إضافة المفتاح الخارجي
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
