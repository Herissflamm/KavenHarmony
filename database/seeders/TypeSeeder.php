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
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Flute',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Guitare',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Batterie',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Piano',
            'id_categories' => '1',    
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Kazoo',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Alto',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Violoncelle',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Contrebasse',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Violon de gambe',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Octobasse',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Banjo',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Contrebassine',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Harpe',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Luth',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Lyre',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Mandoline',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Gouroumi',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Clavecin',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Epinette',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Cymbalum',
            'id_categories' => '1',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Flûte à bec',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Flûte traversière',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Hautbois',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Basson',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Contrebasson',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Cor anglais',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Clarinette',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Saxophone',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Trompette',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Cor d\'harmonie',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Trombone',
            'id_categories' => '2',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Tuba',
            'id_categories' => '2',    
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Xylophone',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Vibraphone',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Marimba',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Timbales',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Tongue Drum',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Caisse claire',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Grosse caisse',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Toms',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Cymbales',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Tambour',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Tambourin',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Triangle',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Castagnettes',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Claves',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Gong',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Caixa',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Tamborin',
            'id_categories' => '3',
        ]);
        DB::table('type_instrument')->insert([
            'type' => 'Batterie',
            'id_categories' => '3',
        ]);
    }
}
