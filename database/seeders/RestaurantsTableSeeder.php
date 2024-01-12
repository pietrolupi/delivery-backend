<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants_data = fopen(__DIR__ . './csv/restaurants_seeding.csv', 'r');

        $i = 0;
        while(($row = fgetcsv($restaurants_data)) !== FALSE){
            if($i > 0){

                $restaurant = new Restaurant();
                $restaurant->user_id = $row[0];
                $restaurant->name = $row[1];
                $restaurant->address = $row[2];
                $restaurant->image = $row[3];
                $restaurant->save();
            }
            $i++;
        }

        fclose($restaurants_data);
    }
}
