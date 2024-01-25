<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders_data = fopen(__DIR__ . './csv/orders_seeding.csv', 'r');

        $i = 0;
        while (($row = fgetcsv($orders_data)) !== false) {
            if ($i > 0) {

                if (count($row) >= 6) {
                    $order = new Order();
                    $order->date = $row[0];
                    $order->total_price = $row[1];
                    $order->customer_name = $row[2];
                    $order->customer_address = $row[3];
                    $order->customer_email = $row[4];
                    $order->customer_phone = $row[5];

                    $order->save();
                }
            }
            $i++;
        }

        fclose($orders_data);
    }
}
