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
        Schema::create('member_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('token', 64)->unique()->index();
            $table->string('paypal_order_id')->nullable();
            $table->decimal('amount_paid', 8, 2)->default(30.00);
            $table->timestamp('used_at')->nullable();
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_access_tokens');
    }
};
