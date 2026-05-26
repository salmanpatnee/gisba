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
            $table->unsignedTinyInteger('section')->default(1)->after('sort_order');
        });

        DB::table('chapters')->where('sort_order', '>=', 16)->update(['section' => 3]);
    }

    public function down(): void
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('section');
        });
    }
};
