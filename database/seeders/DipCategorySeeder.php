<?php

namespace Database\Seeders;

use App\Models\DipCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DipCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Tersedia Setiap Saat',
            'Serta Merta',
            'Berkala',
            'Dikecualikan',
        ];

        foreach ($categories as $category) {
            DipCategory::firstOrCreate(['name' => $category]);
        }
    }
}
