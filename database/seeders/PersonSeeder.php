<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\PersonModel;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         PersonModel::create([
           
        'record_id'     => 1, 
        'first_name'    => 'Basil John',
        'middle_name'   => 'C.' ,
        'last_name'     => 'Manabo' ,
        'extension'     => '',
        'phone_number'  => '0912323213' ,
        'address'       => 'Tuyabang Bajo',
        'email_address' => 'manabobasil@gmail.com',
        'created_at' => '2023-06-19 13:35:39',
        ]);
    }
}
