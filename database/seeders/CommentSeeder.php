<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'task_id' => 1,
            'author_id' => 1,
            'message' => 'admin_message_admin_message_admin_message',
            'kind' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('comments')->insert([
            'task_id' => 1,
            'author_id' => 2,
            'message' => 'user1_message_user1_message_user1_message',
            'kind' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('comments')->insert([
            'task_id' => 3,
            'author_id' => 2,
            'message' => 'user1_message_user1_message_user1_message',
            'kind' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('comments')->insert([
            'task_id' => 4,
            'author_id' => 3,
            'message' => 'user2_message_user2_message_user2_message',
            'kind' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
