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
        // 1. Instructors Table
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('certification')->nullable();
            $table->text('desc')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // 2. Courses Table
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->enum('type', ['beginner', 'intermediate', 'advanced', 'other'])->default('beginner');
            $table->unsignedSmallInteger('sort')->default(0);
            $table->boolean('status')->default(true);
            $table->boolean('coming_soon')->default(false);
            $table->timestamps();

            $table->index('type');
            $table->index('status');
            $table->index('sort');
        });

        // 3. Course Translations Table
        Schema::create('course_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('lang', 5)->default('en')->index();
            $table->string('title');
            $table->text('desc')->nullable();
            $table->longText('objectives')->nullable();
            $table->json('key_points')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('instructors')->nullOnDelete();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['course_id', 'lang']);
            $table->index('course_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_translations');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('instructors');
    }
};
