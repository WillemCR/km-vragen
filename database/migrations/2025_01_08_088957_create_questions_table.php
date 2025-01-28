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
            Schema::create('questions', function (Blueprint $table) {
                $table->id(); // Unieke ID van de vraag
                $table->string('title'); // Titel van de vraag
                $table->text('description'); // Optionele beschrijving van de vraag
                $table->foreignId('pillar_id')->constrained()->onDelete('cascade'); // Verwijzing naar de pijler
                $table->foreignID('sector_id')->default(1) ->constrained()->onDelete('cascade');//
                $table->boolean('is_active')->default(true); // Geeft aan of de vraag actief is
                $table->boolean('has_custom_answer')->default(false);
                $table->timestamps(); // Automatisch gegenereerde created_at en updated_at velden
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
