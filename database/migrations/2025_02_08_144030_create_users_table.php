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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->char('password');
            $table->char('name');
            $table->char('surname');
            $table->char('patronymic');
            $table->text('description')->nullable();
            $table->text('education')->nullable();
            $table->text('direction')->nullable();
            $table->timestamp('reg_date')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('login_time')->nullable();
            $table->integer('usege_time')->default(0);
            $table->char('photo_url', 100);
            $table->rememberToken();
            $table->foreignId('role_id')->constrained('roles');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
    }
};
