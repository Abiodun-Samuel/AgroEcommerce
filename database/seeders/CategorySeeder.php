<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'title' => 'Seeds',
                'slug' => 'seeds',
            ],
            [
                'title' => 'Agrochemical',
                'slug' => 'agrochemical',
            ],
            [
                'title' => 'Irrigation',
                'slug' => 'irrigation',
            ],
            [
                'title' => 'Fertilizers',
                'slug' => 'fertilizers',
            ],
            [
                'title' => 'Growing Media',
                'slug' => 'growing-media',
            ],
            [
                'title' => 'Others',
                'slug' => 'others',
            ],
        ];
        foreach ($data as $k) {
            Category::create([
                'title' => $k['title'],
                'slug' => $k['slug'],
            ]);
        }
    }
}