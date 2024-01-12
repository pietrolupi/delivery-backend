<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types_data = fopen(__DIR__ . './csv/types_seeding.csv', 'r');

        $i = 0;
        while(($row = fgetcsv($types_data)) !== FALSE){
            if($i > 0){

                $type = new Type();
                $type->name = $row[0];
                $type->image = $row[1];
                $type->save();
            }
            $i++;
        }

        fclose($types_data);
    }
}
