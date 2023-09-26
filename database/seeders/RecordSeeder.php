<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecordModel;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        RecordModel::create([
        'p_id'      => 1,
        'record_description' => 'Sample Issue',
        'created_at' => '2023-06-19 13:35:39',
        ]);
    }
}
