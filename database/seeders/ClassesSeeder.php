<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classess;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Sequence;


class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classess::factory()
            ->count(10)
            ->sequence(fn($sequence) => ['name' => 'Class ' . ($sequence->index + 1)])
            ->has(Section::factory()
                ->count(2)
                ->state(new Sequence(
                    ['name' => 'Section A'],
                    ['name' => 'Section B']
                ))
                ->has(Student::factory()->count(5)->state(function (array $attributes, Section $section) {
                    return ['class_id' => $section->class_id]; // Ensure class_id is correctly passed
                }))
            )
            ->create();
    }
}
