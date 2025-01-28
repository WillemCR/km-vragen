<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('default_answers', function (Blueprint $table) {
            $table->id(); // Unique ID for the answer
            $table->string('text'); // Text of the answer
            $table->unsignedInteger('percentage')->default(0); // Percentage for score calculation (e.g., 0-100)
            $table->timestamps(); // Automatically generated created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_answers');
    }
};
