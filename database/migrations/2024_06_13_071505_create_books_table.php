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
        Schema::create('books', function (Blueprint $table) {
            $table->string('id',191);
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('extraLarge')->nullable();
            $table->text('category')->nullable();
            $table->string('publisher')->nullable();
            $table->string('publishedDate')->nullable();
            $table->integer('price')->nullable();
            $table->text('buyLink')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
