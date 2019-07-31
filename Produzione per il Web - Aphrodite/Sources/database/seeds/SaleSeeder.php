<?php

use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sale')->insert(['nome' => 'Sala Galileo',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('sale')->insert(['nome' => 'Sala Pitagora',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('sale')->insert(['nome' => 'Sala Nerone',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('sale')->insert(['nome' => 'Sala Cesare',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('sale')->insert(['nome' => 'Sala Achille',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('sale')->insert(['nome' => 'Sala Ulisse',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('sale')->insert(['nome' => 'Sala Ercole',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('sale')->insert(['nome' => 'Sala Minotauro',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('sale')->insert(['nome' => 'Sala Stark',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('sale')->insert(['nome' => 'Sala Kent',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);
    }
}
