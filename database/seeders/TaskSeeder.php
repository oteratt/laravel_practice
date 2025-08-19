<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードを使うために追記
use Illuminate\Support\Carbon; // 日時を入れるためによく使います
use Database\Seeders\TaskSeeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('posts')->truncate();

        DB::table('tasks')->insert(
            [
                'title' => 'seederで作成したタイトル',
                'content' => 'seederで作成した内容',
                'deadline_at' => Carbon::parse('2025-08-19 12:00:00'),
                'support_at' => Carbon::parse('2025-08-19 12:00:00'),
                'priority' => 1,  
                'status' => 1, 
            ]
        );
    }
}
