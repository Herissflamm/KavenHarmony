<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('state')->insert([
            'state' => 'Mauvais etat',
        ]);
        DB::table('state')->insert([
            'state' => 'En bon etat',
        ]);
        DB::table('state')->insert([
            'state' => 'Etat correct',
        ]);
        DB::table('state')->insert([
            'state' => 'Neuf',
        ]);
    }
}
