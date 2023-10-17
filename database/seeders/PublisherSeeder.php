<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i=0; $i < 20; $i++){
            $book = new Publisher;

            $book->name = $faker->company;
            $book->email = $faker->email;
            $book->phone_number = '0895'.$faker->randomNumber(8);
            $book->address = $faker->address;

            $book->save();
        }
    }
}
