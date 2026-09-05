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
        Schema::dropIfExists('bookmark_items');
        Schema::dropIfExists('bookmark_collections');
        Schema::dropIfExists('likes');

        Schema::dropIfExists('activity_log');
        Schema::dropIfExists('telescope_entries_tags');
        Schema::dropIfExists('telescope_entries');
        Schema::dropIfExists('telescope_monitoring');

        Schema::dropIfExists('topic_quran_verse');
        Schema::dropIfExists('topic_hadith');
        Schema::dropIfExists('topic_videos');
        Schema::dropIfExists('topic_translations');
        Schema::dropIfExists('topics');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not providing a down method because the tables and models are completely removed
    }
};
