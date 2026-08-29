<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hadith_verse_import_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hadith_book_id')->constrained('hadith_books')->onDelete('CASCADE');

            $table->foreignId('hadith_chapter_id')->nullable()->constrained('hadith_chapters')->onDelete('CASCADE');

            // Page tracking
            $table->unsignedInteger('total_pages')->default(0);
            $table->json('success_pages')->nullable()->comment('Array of successfully imported page numbers');
            $table->json('failed_pages')->nullable()->comment('Array of page numbers that failed');
            $table->json('failed_hadiths')->nullable()->comment('Array of {page, hadith_id, reason}');

            // Status: pending | in_progress | completed | failed
            $table->string('status', 20)->default('pending');

            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            // One log per book+chapter combo (null chapter = whole-book import)
            $table->unique(['hadith_book_id', 'hadith_chapter_id'], 'unique_book_chapter_log');

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hadith_verse_import_logs');
    }
};
