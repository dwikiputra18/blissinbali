<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('highlight_text')->nullable();
            $table->text('description')->nullable();
            $table->string('button_text')->default('Selengkapnya');
            $table->string('button_link')->default('#');
            $table->string('image');
            $table->string('gradient_color')->default('from-indigo-400 to-purple-600');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};