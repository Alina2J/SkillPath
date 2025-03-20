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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->char('title');
            $table->foreignId('sub_category_id')->constrained('sub_categories');
            $table->char('duration');
            $table->integer('count_lessons');
            $table->foreignId('teacher_id')->constrained('users');
            $table->text('description');
            $table->char('price');
            $table->char('photo_url', 100);
            $table->integer('count_students')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
