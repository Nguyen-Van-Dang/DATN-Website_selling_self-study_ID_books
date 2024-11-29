<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $classes = ['Lớp 10', 'Lớp 11', 'Lớp 12'];
    
        foreach ($classes as $class) {
            \App\Models\ClassModel::create(['name' => $class]);
        }
    }
}
