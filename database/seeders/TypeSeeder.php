<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_instrument')->insert([
            'type' => 'Violon',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Flute',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Guitare',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Batterie',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Piano',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Kazoo',
        ]);
    }
}
