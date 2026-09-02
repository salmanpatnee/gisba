<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Migrates the coupon codes previously hardcoded in the checkout controllers
     * (MEPAK50, ISACA50, ISACA90, MEPAK90) into the coupons table.
     */
    public function up(): void
    {
        $now = now();

        DB::table('coupons')->insert([
            ['name' => 'MEPAK50', 'value' => 50, 'expires_at' => null, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ISACA50', 'value' => 50, 'expires_at' => null, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ISACA90', 'value' => 90, 'expires_at' => null, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MEPAK90', 'value' => 90, 'expires_at' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('coupons')->whereIn('name', ['MEPAK50', 'ISACA50', 'ISACA90', 'MEPAK90'])->delete();
    }
};
