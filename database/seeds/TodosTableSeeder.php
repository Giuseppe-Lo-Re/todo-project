<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Todo;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Autogenerate Todos for testing table
        for($i = 0; $i < 10; $i++) {
            $new_todo = new Todo();
            $new_todo->order_position = rand(1,10);
            $new_todo->description = ucfirst($faker->sentence(rand(3,7)));
            $new_todo->save();
        }
    }
}

