<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->decimal('regular_price', 8, 2)->default(2495.00)->after('success_stories_region');
            $table->decimal('sale_price', 8, 2)->default(1500.00)->after('regular_price');
        });

        // Migrate existing pricing data into the site_settings row
        $pricing = DB::table('nis2_pricing')->first();
        if ($pricing) {
            DB::table('site_settings')->update([
                'regular_price' => $pricing->regular_price,
                'sale_price' => $pricing->sale_price,
            ]);
        }

        Schema::dropIfExists('nis2_pricing');
    }

    public function down(): void
    {
        Schema::create('nis2_pricing', function (Blueprint $table) {
            $table->id();
            $table->decimal('regular_price', 8, 2)->default(2495.00);
            $table->decimal('sale_price', 8, 2)->default(1500.00);
            $table->timestamps();
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['regular_price', 'sale_price']);
        });
    }
};
