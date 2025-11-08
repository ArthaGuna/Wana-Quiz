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
        Schema::create('ai_prompts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // admin
            $table->string('nama_prompt'); // nama template prompt
            $table->text('template_prompt'); // template prompt untuk AI
            $table->string('model_id'); // model AI (gpt-4, gemini-pro, dll)
            $table->integer('max_tokens'); // maksimal token
            $table->decimal('temperature', 3, 2)->default(0.7); // kreativitas AI
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_prompts');
    }
};
