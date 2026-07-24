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
        Schema::create('session_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_session_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type', 30)->default('page_visit');
            $table->string('route_name', 150)->nullable();
            $table->string('url', 255);
            $table->string('method', 10)->default('GET');
            $table->string('label', 150)->nullable();
            $table->string('module', 60)->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('occurred_at');
            $table->timestamp('created_at')->useCurrent();

            $table->index(['user_session_id', 'occurred_at']);
            $table->index(['user_id', 'occurred_at']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_activities');
    }
};
