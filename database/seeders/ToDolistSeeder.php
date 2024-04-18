<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Todo;


class ToDolistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public function run()
    {

        Model::unguard();

        $faker = Faker::create();


        $categoryIds = Category::pluck('id')->toArray();



        for ($i = 0; $i < 5; $i++) { // Create 10 example ToDo items
            $categoryId = $faker->randomElement($categoryIds);
            $userId = Category::find($categoryId)->user_id;
            Todo::create([
                'title' => $faker->sentence,
                'category' => $categoryId,
                'user_id' => $userId,
                'completed' => 0,
                 
            ]);


}
    }
}