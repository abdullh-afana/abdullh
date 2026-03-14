<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;
class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            ['name' => 'الصف الأول', 'slug' => 'grade-1', 'stage' => 'primary'],
            ['name' => 'الصف الثاني', 'slug' => 'grade-2', 'stage' => 'primary'],
            ['name' => 'الصف الثالث', 'slug' => 'grade-3', 'stage' => 'primary'],
            ['name' => 'الصف الرابع', 'slug' => 'grade-4', 'stage' => 'primary'],
            ['name' => 'الصف الخامس', 'slug' => 'grade-5', 'stage' => 'primary'],
            ['name' => 'الصف السادس', 'slug' => 'grade-6', 'stage' => 'primary'],
            ['name' => 'الصف السابع', 'slug' => 'grade-7', 'stage' => 'middle'],
            ['name' => 'الصف الثامن', 'slug' => 'grade-8', 'stage' => 'middle'],
            ['name' => 'الصف التاسع', 'slug' => 'grade-9', 'stage' => 'middle'],
            ['name' => 'الصف العاشر', 'slug' => 'grade-10', 'stage' => 'high'],
            ['name' => 'الصف الحادي عشر - علمي', 'slug' => 'grade-11-sci', 'stage' => 'high'],
            ['name' => 'الصف الحادي عشر - أدبي', 'slug' => 'grade-11-lit', 'stage' => 'high'],
            ['name' => 'الصف الثاني عشر - علمي', 'slug' => 'grade-12-sci', 'stage' => 'high'],
            ['name' => 'الصف الثاني عشر - أدبي', 'slug' => 'grade-12-lit', 'stage' => 'high'],
        ];
        foreach ($grades as $grade) {
            // البحث عن الصف بواسطة الـ slug، وإذا لم يجده ينشئه، وإذا وجده يحدّث البيانات
            Grade::updateOrCreate(['slug' => $grade['slug']], $grade);
        }
    }
}
