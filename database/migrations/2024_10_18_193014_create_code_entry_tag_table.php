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
        Schema::create('code_entry_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('code_entry_id')->constrained('code_entries')->onDelete('cascade');
            $table->foreignId('code_tag_id')->constrained('code_tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_entry_tag');
    }
};

