<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'team_id' => '1',
            'title' => 'task1.1_title',
            'body' => 'task1.1_body',
            'assignee_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'team_id' => '1',
            'title' => 'task1.2_title',
            'body' => 'task1.2_body',
            'assignee_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'team_id' => '2',
            'title' => 'task2.1_title',
            'body' => 'task2.1_body',
            'assignee_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('tasks')->insert([
            'team_id' => '3',
            'title' => 'task3.1_title',
            'body' => 'task3.1_body',
            'assignee_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
