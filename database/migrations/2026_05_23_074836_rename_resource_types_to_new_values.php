<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('resources')->where('resource_type', 'video')->update(['resource_type' => 'tutorial']);
        DB::table('resources')->where('resource_type', 'document')->update(['resource_type' => 'takeaway']);
        DB::table('resources')->where('resource_type', 'checklist')->update(['resource_type' => 'quizzes']);
        DB::table('resources')->where('resource_type', 'glossary')->update(['resource_type' => 'domain_summary']);
    }

    public function down(): void
    {
        DB::table('resources')->where('resource_type', 'tutorial')->update(['resource_type' => 'video']);
        DB::table('resources')->where('resource_type', 'takeaway')->update(['resource_type' => 'document']);
        DB::table('resources')->where('resource_type', 'quizzes')->update(['resource_type' => 'checklist']);
        DB::table('resources')->where('resource_type', 'domain_summary')->update(['resource_type' => 'glossary']);
    }
};
