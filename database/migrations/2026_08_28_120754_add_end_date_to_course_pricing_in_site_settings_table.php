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
            $table->date('crisc_end_date')->nullable()->after('crisc_date');
            $table->date('cissp_end_date')->nullable()->after('cissp_date');
            $table->date('prince2_end_date')->nullable()->after('prince2_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['crisc_end_date', 'cissp_end_date', 'prince2_end_date']);
        });
    }
};
