<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['HTML', 'CSS', 'scss', 'JavaScript', 'PHP', 'MySQL', 'Bootstrap', 'Wordpress', 'Laravel', 'API', 'Node.js'];

        foreach ($data as $technology){
            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Str::slug($technology, '-');
            $new_technology->save();
        }
    }
}
