<?php

namespace Database\Seeders;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_recipes = config('recipes');
        foreach ($all_recipes as $recipe) {
            $new_recipe = new Recipe();

            $new_recipe->name = $recipe['name'];
            $new_recipe->description = $recipe['description'];
            $new_recipe->ingredient =$recipe['ingredient'];
            $new_recipe->number_of_person = $recipe['number_of_person'];
            $new_recipe->time = $recipe['time'];
            $new_recipe->image = $recipe['image'];
            $new_recipe->save();

        }
    }
}
