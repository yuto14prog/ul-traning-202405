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
            'user_id' => 2,
        ]);
        DB::table('members')->insert([
            'team_id' => 2,
            'user_id' => 3,
        ]);
    }
}
