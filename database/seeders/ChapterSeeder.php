<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ChapterSeeder extends Seeder
{
    public function run(): void
    {
        $source = 'E:\\Downloads\\PMP Web Boxes';
        $dest = storage_path('app/public/chapters/images');

        File::ensureDirectoryExists($dest);

        $chapters = [
            [1, 'Introduction'],
            [2, 'History of Project Management'],
            [3, 'Basic understanding of the Key Concepts'],
            [4, 'PMI Exam Objectives'],
            [5, 'Introduction to PMBOK-8th Edition'],
            [6, 'Governance Performance Domain'],
            [7, 'Scope Performance Domain'],
            [8, 'Schedule Performance Domain'],
            [9, 'Finance Performance Domain'],
            [10, 'Stakeholder Performance Domain'],
            [11, 'Resources Performance Domain'],
            [12, 'Risk Performance Domain'],
            [13, 'Tailoring'],
            [14, 'Input and Output'],
            [15, 'Tools and Techniques'],
            [16, 'Applying Project Management Techniques'],
            [17, 'Tips to Pass the PMP Exam'],
            [18, 'Memory Pegs and Practical Tips'],
            [19, 'Other Project Management Resource'],
            [20, 'Beyond PMP'],
        ];

        foreach ($chapters as [$order, $title]) {
            $slug = Str::slug($title);
            $imagePath = "chapters/images/{$slug}.jpg";
            $sourceFile = "{$source}\\{$title}.JPG";

            if (File::exists($sourceFile)) {
                File::copy($sourceFile, "{$dest}/{$slug}.jpg");
            }

            Chapter::firstOrCreate(
                ['title' => $title],
                [
                    'slug' => $slug,
                    'sort_order' => $order,
                    'image_path' => $imagePath,
                ]
            );
        }
    }
}
