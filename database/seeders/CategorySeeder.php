<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'General Topics',
            'Quick Tips',
            'Cybersecurity Governance',
            'Policies and Procedure Management',
            'Risk Management',
            'Human Resource',
            'Cybersecurity Training & Awareness',
            'Asset Management',
            'Identity and Access Management',
            'Network Security',
            'Cryptography',
            'Backup & Recovery Management',
            'Vulnerability & Penetration Testing',
            'Incident Handling',
            'Physical Security',
            'Application Development',
            'Business Continuity and Crises Management',
            'Supply Chain',
            'Others',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}
