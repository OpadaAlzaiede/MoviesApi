<?php

namespace Modules\Movie\Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Modules\Movie\Entities\Movie;
use Modules\Movie\Entities\Category;
use Illuminate\Database\Eloquent\Model;


class MovieDatabaseSeeder extends Seeder
{
    protected Faker $faker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        for($i = 0; $i < 10; $i++) {
            $category = Category::factory()->make();

            $category->save();
        }

        for($i = 0; $i < 20; $i++) {
            $movie = Movie::factory()->make();

            $movie->save();
        }
    }
}
