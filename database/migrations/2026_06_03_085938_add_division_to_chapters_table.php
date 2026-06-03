<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->unsignedTinyInteger('division')->nullable()->after('section');
        });

        // Backfill existing Part 2 chapters by sort_order range (scoped to section 2)
        DB::table('chapters')->where('section', 2)->where('sort_order', '<=', 8)->update(['division' => 1]);
        DB::table('chapters')->where('section', 2)->whereBetween('sort_order', [9, 18])->update(['division' => 2]);
        DB::table('chapters')->where('section', 2)->where('sort_order', '>=', 19)->update(['division' => 3]);
    }

    public function down(): void
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('division');
        });
    }
};
