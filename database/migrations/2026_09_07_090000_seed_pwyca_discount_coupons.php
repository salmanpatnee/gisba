<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Seeds the DISACP10..DISACP90 coupon codes used by the Pay-What-You-Can-Afford
     * discount request form on the home page (percentage selected maps directly
     * to the coupon name, e.g. 30% -> DISACP30).
     */
    public function up(): void
    {
        $now = now();

        DB::table('coupons')->insertOrIgnore(
            collect(range(10, 90, 10))->map(fn (int $percentage) => [
                'name' => 'DISACP'.$percentage,
                'value' => $percentage,
                'expires_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ])->all()
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('coupons')->whereIn(
            'name',
            collect(range(10, 90, 10))->map(fn (int $percentage) => 'DISACP'.$percentage)->all()
        )->delete();
    }
};
