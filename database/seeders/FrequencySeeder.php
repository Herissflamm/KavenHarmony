<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('frequency')->insert([
            'frequency' => 'jour',
        ]);
        DB::table('frequency')->insert([
            'frequency' => 'semaine',
        ]);
        DB::table('frequency')->insert([
            'frequency' => 'mois',
        ]);
    }
}
