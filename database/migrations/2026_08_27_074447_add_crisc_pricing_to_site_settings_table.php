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
            $table->decimal('crisc_price', 8, 2)->default(9.99);
            $table->string('crisc_currency')->default('USD');
            $table->date('crisc_date')->nullable();
            $table->string('crisc_time_start')->nullable();
            $table->string('crisc_time_end')->nullable();
            $table->string('crisc_timezone')->default('GMT+3');
            $table->unsignedInteger('crisc_capacity')->default(12);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'crisc_price',
                'crisc_currency',
                'crisc_date',
                'crisc_time_start',
                'crisc_time_end',
                'crisc_timezone',
                'crisc_capacity',
            ]);
        });
    }
};
