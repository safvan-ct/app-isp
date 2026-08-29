<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hadith_json_import_logs', function (Blueprint $table) {
            $table->id();
            $table->string('source_file')->unique();
            $table->foreignId('hadith_book_id')->nullable()->constrained('hadith_books')->nullOnDelete();
            $table->unsignedTinyInteger('total_steps')->default(3);
            $table->json('success_steps')->nullable();
            $table->json('failed_steps')->nullable();
            $table->json('failed_items')->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hadith_json_import_logs');
    }
};
