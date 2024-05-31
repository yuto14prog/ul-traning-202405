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
            'name' => 'team1',
            'owner_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teams')->insert([
            'name' => 'team2',
            'owner_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teams')->insert([
            'name' => 'team3',
            'owner_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
