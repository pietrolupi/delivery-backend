<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurant_type_data = fopen(__DIR__ . '/csv/restaurant_type_seeding.csv', 'r');

        $i = 0;
        while(($row = fgetcsv($restaurant_type_data)) !== FALSE){
            if($i > 0){

                DB::table('restaurant_type')->insert([
                    'restaurant_id' => $row[0],
                    'type_id' => $row[1]
                ]);

            }
            $i++;
        }

        fclose($restaurant_type_data);
    }

}
