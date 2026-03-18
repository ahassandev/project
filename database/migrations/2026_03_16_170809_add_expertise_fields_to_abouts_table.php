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
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('expertise_label')->default('Our Expertise');
            $table->string('expertise_title')->default('WE ARE THE LEADER IN CONSULTANCY & CERTIFICATIONS');
            $table->text('expertise_subtitle')->nullable();
            $table->text('expertise_description')->nullable();
            $table->string('expertise_image')->nullable();
            $table->string('expertise_experience_years')->default('20+');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'expertise_label',
                'expertise_title',
                'expertise_subtitle',
                'expertise_description',
                'expertise_image',
                'expertise_experience_years'
            ]);
        });
    }
};
