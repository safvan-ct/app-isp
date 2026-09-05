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
        // Update lesson_reference_quran table
        Schema::table('lesson_reference_quran', function (Blueprint $table) {
            $table->dropForeign(['lesson_id']);
            $table->dropColumn('lesson_id');
            $table->foreignId('lesson_reference_id')->after('id')->constrained('lesson_references')->onDelete('cascade');
            $table->index('lesson_reference_id');
        });

        // Update lesson_reference_hadith table
        Schema::table('lesson_reference_hadith', function (Blueprint $table) {
            $table->dropForeign(['lesson_id']);
            $table->dropColumn('lesson_id');
            $table->foreignId('lesson_reference_id')->after('id')->constrained('lesson_references')->onDelete('cascade');
            $table->index('lesson_reference_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_reference_hadith', function (Blueprint $table) {
            $table->dropForeign(['lesson_reference_id']);
            $table->dropColumn('lesson_reference_id');
            $table->foreignId('lesson_id')->after('id')->constrained('lessons')->onDelete('cascade');
            $table->index('lesson_id');
        });

        Schema::table('lesson_reference_quran', function (Blueprint $table) {
            $table->dropForeign(['lesson_reference_id']);
            $table->dropColumn('lesson_reference_id');
            $table->foreignId('lesson_id')->after('id')->constrained('lessons')->onDelete('cascade');
            $table->index('lesson_id');
        });
    }
};
