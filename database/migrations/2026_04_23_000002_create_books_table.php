<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('title', 200);
            $table->string('author', 150);
            $table->string('isbn', 20)->nullable();
            $table->text('description')->nullable();
            $table->enum('condition', ['new', 'good', 'fair', 'poor']);
            $table->string('cover_image', 255)->nullable();
            $table->enum('status', ['available', 'pending', 'exchanged'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
