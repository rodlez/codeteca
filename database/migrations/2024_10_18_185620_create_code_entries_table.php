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
        Schema::create('code_entries', function (Blueprint $table) {
            $table->id();
            // create the user_id column that be the foreign key id in the users DB Table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // create the type_id column that be the foreign key id in the types DB Table
            $table->foreignId('type_id')->constrained('code_types');
            // create the category_id column that be the foreign key id in the categories DB Table
            $table->foreignId('category_id')->constrained('code_categories');
            $table->string('title');
            $table->text('url')->nullable();
            $table->text('info')->nullable();
            $table->text('code')->nullable();
            $table->timestamps();
        });

        Schema::table('code_entries', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('type_id');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_entries');
    }
};
