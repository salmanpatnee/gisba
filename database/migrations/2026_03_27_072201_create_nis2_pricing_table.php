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
        Schema::create('nis2_pricing', function (Blueprint $table) {
            $table->id();
            $table->decimal('regular_price', 8, 2)->default(2495.00);
            $table->decimal('sale_price', 8, 2)->default(1500.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nis2_pricing');
    }
};
