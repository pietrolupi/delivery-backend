<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderProduct;

class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order_product_data = fopen(__DIR__ . './csv/order_product_seeding.csv', 'r');

        $i = 0;
        while(($row = fgetcsv($order_product_data)) !== FALSE){
            if($i > 0){

                $order_product = new OrderProduct();
                $order_product->order_id = $row[0];
                $order_product->product_id = $row[1];
                $order_product->product_quantity = $row[2];

                $order_product->save();

            }
            $i++;
        }

        fclose($order_product_data);
    }
}
