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
        // 1. Lesson Contents Table
        Schema::create('lesson_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->string('lang', 5)->default('en')->index();
            $table->longText('notes')->nullable();
            $table->json('key_notes')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['lesson_id', 'lang']);
            $table->index('lesson_id');
            $table->index('status');
        });

        // 2. Lesson General References Table
        Schema::create('lesson_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->string('title');
            $table->text('simplified')->nullable();
            $table->json('translations')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index('lesson_id');
            $table->index('status');
        });

        // 3. Lesson Quran References Table
        Schema::create('lesson_reference_quran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->foreignId('surah_id')->constrained('quran_chapters')->onDelete('cascade');
            $table->unsignedSmallInteger('verse_no');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index('lesson_id');
            $table->index('surah_id');
            $table->index('status');
        });

        // 4. Lesson Hadith References Table
        Schema::create('lesson_reference_hadith', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->foreignId('hadith_verse_id')->constrained('hadith_verses')->onDelete('cascade');
            $table->unsignedSmallInteger('verse_no');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index('lesson_id');
            $table->index('hadith_verse_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_reference_hadis');
        Schema::dropIfExists('lesson_reference_quran');
        Schema::dropIfExists('lesson_references');
        Schema::dropIfExists('lesson_contents');
    }
};
