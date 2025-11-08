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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attempt_id')->constrained('quiz_attempts')->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('selected_option_id')->nullable()->constrained('options')->onDelete('cascade');
            $table->text('jawaban_essay')->nullable(); // untuk jawaban essay
            $table->text('ai_feedback')->nullable(); // feedback dari AI untuk essay
            $table->decimal('ai_score', 5, 2)->nullable(); // nilai dari AI (0-100)
            $table->decimal('final_score', 8, 2)->default(0); // nilai akhir
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
