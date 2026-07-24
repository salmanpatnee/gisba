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
        Schema::create('user_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('session_token', 36)->unique();
            $table->timestamp('login_at');
            $table->timestamp('logout_at')->nullable();
            $table->timestamp('last_activity_at');
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->string('status', 20)->default('Active');
            $table->string('login_method', 50)->default('password');
            $table->string('ip_address', 45)->nullable();
            $table->string('browser', 50)->nullable();
            $table->string('platform', 50)->nullable();
            $table->string('device_type', 20)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['status', 'last_activity_at']);
            $table->index('login_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sessions');
    }
};
