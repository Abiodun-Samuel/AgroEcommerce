<?php

namespace Database\Seeders;

use App\Models\Admin\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Insecticides',
                'slug' => 'insecticides',
                'category_id' => '97db78ba-acc2-40fc-961b-880028b7d297'
            ],
            [
                'title' => 'Fungicides',
                'slug' => 'fungicides',
                'category_id' => '97db78ba-acc2-40fc-961b-880028b7d297'
            ],
            [
                'title' => 'Herbicides',
                'slug' => 'herbicides',
                'category_id' => '97db78ba-acc2-40fc-961b-880028b7d297'
            ],
            [
                'title' => 'Acaricides',
                'slug' => 'acaricides',
                'category_id' => '97db78ba-acc2-40fc-961b-880028b7d297'
            ],
        ];
        foreach ($data as $k) {
            SubCategory::create([
                'title' => $k['title'],
                'slug' => $k['slug'],
                'category_id' => $k['category_id'],
            ]);
        }
    }
}