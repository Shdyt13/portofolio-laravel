<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            
            // Kolom wajib
            $table->string('name');
            $table->string('title');
            $table->text('about');
            
            // Kolom opsional (nullable)
            $table->string('avatar')->nullable();
            $table->string('cv_link')->nullable();
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            
            // Kolom bawaan lama (dipertahankan untuk berjaga-jaga)
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};