<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'team_id' => 1,
            'user_id' => 1,
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('members')->insert([
            'team_id' => 2,
            'user_id' => 2,
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('members')->insert([
            'team_id' => 3,
            'user_id' => 3,
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('members')->insert([
            'team_id' => 1,
            'user_id' => 2,
            'role' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('members')->insert([
            'team_id' => 1,
            'user_id' => 3,
            'role' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
