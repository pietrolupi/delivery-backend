<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products_data = fopen(__DIR__ . './csv/products_seeding.csv', 'r');

        $i = 0;
        while(($row = fgetcsv($products_data)) !== FALSE){
            if($i > 0){

                $product = new Product();
                $product->restaurant_id = $row[0];
                $product->name = $row[1];
                $product->ingredients = $row[2];
                $product->description = $row[3];
                $product->price = $row[4];
                $product->visibility = $row[5];
                $product->image = $row[6];
                $product->save();
            }
            $i++;
        }

        fclose($products_data);
    }
}
