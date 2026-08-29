<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // MODIFY is MySQL-only; sqlite (used by the test suite) has no strict column typing to relax.
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement('ALTER TABLE `site_settings` MODIFY `crisc_capacity` VARCHAR(50) NOT NULL DEFAULT \'12\'');
        DB::statement('ALTER TABLE `site_settings` MODIFY `cissp_capacity` VARCHAR(50) NOT NULL DEFAULT \'15\'');
        DB::statement('ALTER TABLE `site_settings` MODIFY `prince2_capacity` VARCHAR(50) NOT NULL DEFAULT \'15\'');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement('ALTER TABLE `site_settings` MODIFY `crisc_capacity` INT UNSIGNED NOT NULL DEFAULT 12');
        DB::statement('ALTER TABLE `site_settings` MODIFY `cissp_capacity` INT UNSIGNED NOT NULL DEFAULT 15');
        DB::statement('ALTER TABLE `site_settings` MODIFY `prince2_capacity` INT UNSIGNED NOT NULL DEFAULT 15');
    }
};
