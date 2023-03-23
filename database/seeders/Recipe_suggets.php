<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipes_suggest;
use Faker\Generator as Faker;

class Recipe_suggest extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $user = new Recipes_suggest();
        $user->email = $faker->email();
        $user->object = $faker->word();
        $user->text = $faker->word();
        $user->news_letter = $faker->boolean();
        $user->save();
    }
}
