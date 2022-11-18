<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert(
            [
                [
                    'name' => 'api',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'json',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'schema',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'node',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'github',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'rest',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'organization',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'planning',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'collaboration',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'writing',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'calendar',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name' => 'framework',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'node',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'http2',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'https',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'localhost',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
