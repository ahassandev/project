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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('About Us');
            $table->string('mission_title')->default('Our Mission');
            $table->text('mission_content');
            $table->string('vision_title')->default('Our Vision');
            $table->text('vision_content');
            $table->text('team_content');
            $table->text('standards_content');
            $table->text('excellence_content');
            $table->text('professional_statement');
            $table->string('hero_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
