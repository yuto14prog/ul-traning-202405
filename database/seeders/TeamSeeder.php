<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'name' => 'test1',
            'owner_id' => '1',
        ]);
        DB::table('teams')->insert([
            'name' => 'test2',
            'owner_id' => '2',
        ]);
    }
}
