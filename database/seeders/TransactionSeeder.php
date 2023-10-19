<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i=0; $i < 5; $i++){
            $transaction = new Transaction;

            $transaction->date_start = $faker->date;
            $transaction->date_end = $faker->date;
            $transaction->member_id = rand(1, 20);
            $transaction->status = $faker->boolean;

            $transaction->save();
        }
    }
}
