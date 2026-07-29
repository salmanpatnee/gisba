<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membership pricing previously lived in two places that drifted apart: the
     * paywall advertised $30 while PayPalService charged a hardcoded $3.00.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->decimal('membership_price', 8, 2)->default(30.00)->after('sale_price');
            $table->decimal('membership_regular_price', 8, 2)->default(59.00)->after('membership_price');
            $table->string('membership_currency', 3)->default('USD')->after('membership_regular_price');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['membership_price', 'membership_regular_price', 'membership_currency']);
        });
    }
};
