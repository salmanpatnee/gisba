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
            $table->decimal('cissp_price', 8, 2)->default(999.99);
            $table->string('cissp_currency')->default('USD');
            $table->date('cissp_date')->nullable();
            $table->string('cissp_time_start')->nullable();
            $table->string('cissp_time_end')->nullable();
            $table->string('cissp_timezone')->default('Saudi Arabia Standard Time');
            $table->unsignedInteger('cissp_capacity')->default(15);

            $table->decimal('prince2_price', 8, 2)->default(999.99);
            $table->string('prince2_currency')->default('USD');
            $table->date('prince2_date')->nullable();
            $table->string('prince2_time_start')->nullable();
            $table->string('prince2_time_end')->nullable();
            $table->string('prince2_timezone')->default('Saudi Arabia Standard Time');
            $table->unsignedInteger('prince2_capacity')->default(15);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'cissp_price',
                'cissp_currency',
                'cissp_date',
                'cissp_time_start',
                'cissp_time_end',
                'cissp_timezone',
                'cissp_capacity',
                'prince2_price',
                'prince2_currency',
                'prince2_date',
                'prince2_time_start',
                'prince2_time_end',
                'prince2_timezone',
                'prince2_capacity',
            ]);
        });
    }
};
