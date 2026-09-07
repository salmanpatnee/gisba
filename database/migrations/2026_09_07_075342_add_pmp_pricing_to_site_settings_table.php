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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->decimal('pmp_price', 8, 2)->default(999.99);
            $table->string('pmp_currency')->default('USD');
            $table->date('pmp_date')->nullable();
            $table->date('pmp_end_date')->nullable();
            $table->string('pmp_time_start')->nullable();
            $table->string('pmp_time_end')->nullable();
            $table->string('pmp_timezone')->default('Saudi Arabia Standard Time');
            $table->string('pmp_capacity', 50)->default('15');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'pmp_price',
                'pmp_currency',
                'pmp_date',
                'pmp_end_date',
                'pmp_time_start',
                'pmp_time_end',
                'pmp_timezone',
                'pmp_capacity',
            ]);
        });
    }
};
