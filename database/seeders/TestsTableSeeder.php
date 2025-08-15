<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードを使うために追記
use Illuminate\Support\Carbon; // 日時を入れるためによく使います


class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tests')->truncate();
        DB::table('tests')->insert(
            [
                'title' => 'テスト',
                'content'=>'aaaaaa',
            ]
        );
    }
}
