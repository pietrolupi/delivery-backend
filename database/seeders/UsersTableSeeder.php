<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users_data = fopen(__DIR__ . './csv/users_seeding.csv', 'r');

        $i = 0;
        while(($row = fgetcsv($users_data)) !== FALSE){
            if($i > 0){

                $user = new User();
                $user->name = $row[0];
                $user->email = $row[1];
                $user->password = bcrypt($row[2]);
                $user->vat = $row[3];
                $user->save();
            }
            $i++;
        }

        fclose($users_data);

    }
}
