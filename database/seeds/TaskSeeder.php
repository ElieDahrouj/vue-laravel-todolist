<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Task;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $post = new Task();
            $post->description = $faker->realText(300);
            $post->save();
        }
    }
}
