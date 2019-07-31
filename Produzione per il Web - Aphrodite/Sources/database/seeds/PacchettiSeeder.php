<?php

use Illuminate\Database\Seeder;

class PacchettiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Solo Danza moderna',
            'prezzo' => '90.00',
            'corso_I' => '1',
            'corso_II' => NULL,
            'corso_III' => NULL,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Solo Danza classica',
            'prezzo' => '160.00',
            'corso_I' => '2',
            'corso_II' => NULL,
            'corso_III' => NULL,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Solo Pizzica e tarantella',
            'prezzo' => '55.00',
            'corso_I' => '3',
            'corso_II' => NULL,
            'corso_III' => NULL,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Solo Ginnastica artistica',
            'prezzo' => '125.00',
            'corso_I' => '4',
            'corso_II' => NULL,
            'corso_III' => NULL,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Solo Sala pesi',
            'prezzo' => '40.00',
            'corso_I' => '5',
            'corso_II' => NULL,
            'corso_III' => NULL,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Solo Aerobica',
            'prezzo' => '65.00',
            'corso_I' => '6',
            'corso_II' => NULL,
            'corso_III' => NULL,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Solo Crossfit',
            'prezzo' => '100.00',
            'corso_I' => '7',
            'corso_II' => NULL,
            'corso_III' => NULL,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Danza totale',
            'prezzo' => '200.00',
            'corso_I' => '1',
            'corso_II' => '2',
            'corso_III' => NULL,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Senza fiato',
            'prezzo' => '180.00',
            'corso_I' => '5',
            'corso_II' => '6',
            'corso_III' => '7',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('pacchetti_corsi')->insert([
            'nome' => 'Arte classica',
            'prezzo' => '240.00',
            'corso_I' => '2',
            'corso_II' => '4',
            'corso_III' => NULL,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);
    }
}
