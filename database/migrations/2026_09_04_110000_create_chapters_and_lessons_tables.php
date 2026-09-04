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
        // 1. Chapters Table
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('slug');
            $table->unsignedSmallInteger('sort')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['course_id', 'slug']);
            $table->index('course_id');
            $table->index('sort');
            $table->index('status');
        });

        // 2. Chapter Translations Table
        Schema::create('chapter_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained('chapters')->onDelete('cascade');
            $table->string('lang', 5)->default('en')->index();
            $table->string('title');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['chapter_id', 'lang']);
            $table->index('chapter_id');
            $table->index('status');
        });

        // 3. Lessons Table
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained('chapters')->onDelete('cascade');
            $table->string('slug');
            $table->unsignedSmallInteger('sort')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['chapter_id', 'slug']);
            $table->index('chapter_id');
            $table->index('sort');
            $table->index('status');
        });

        // 4. Lesson Translations Table
        Schema::create('lesson_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->string('lang', 5)->default('en')->index();
            $table->string('title');
            $table->text('desc')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['lesson_id', 'lang']);
            $table->index('lesson_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_translations');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('chapter_translations');
        Schema::dropIfExists('chapters');
    }
};
