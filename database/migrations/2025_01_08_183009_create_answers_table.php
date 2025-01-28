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
            $table->id(); // Unieke ID van het antwoord
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Verwijzing naar de vraag
            $table->string('text'); // Tekst van het antwoord
            $table->unsignedInteger('percentage')->default(0); // Percentage voor scoreberekening (bijv. 0-100)
            $table->timestamps(); // Automatisch gegenereerde created_at en updated_at velden
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
