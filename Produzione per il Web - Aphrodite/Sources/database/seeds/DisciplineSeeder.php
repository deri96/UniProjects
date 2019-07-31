<?php

use Illuminate\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discipline')->insert(['nome' => 'Danza',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('discipline')->insert(['nome' => 'Arti marziali',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('discipline')->insert(['nome' => 'Corpo libero',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('discipline')->insert(['nome' => 'Meditazione',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('discipline')->insert(['nome' => 'Atletica leggera',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('discipline')->insert(['nome' => 'Pesistica',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('discipline')->insert(['nome' => 'Palestra',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);
    }
}
