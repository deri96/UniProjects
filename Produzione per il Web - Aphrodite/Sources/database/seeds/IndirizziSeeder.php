<?php

use Illuminate\Database\Seeder;

class IndirizziSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indirizzi')->insert([
            'via' => 'Via Pupino',
            'numero_civico' => '54',
            'citta' => 'Taranto',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Flaminia',
            'numero_civico' => '30',
            'citta' => 'Sava',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Montenapoleone',
            'numero_civico' => '187',
            'citta' => 'Grottaglie',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Toledo',
            'numero_civico' => '63',
            'citta' => 'Manduria',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Roma',
            'numero_civico' => '19',
            'citta' => 'Sava',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Fiume',
            'numero_civico' => '17',
            'citta' => 'Sava',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Bernini',
            'numero_civico' => '99',
            'citta' => 'Manduria',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Pernice',
            'numero_civico' => '24',
            'citta' => 'Fragagnano',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Albona',
            'numero_civico' => '14',
            'citta' => 'Sava',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Giannuzzi',
            'numero_civico' => '18',
            'citta' => 'Carosino',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via D\'acquino',
            'numero_civico' => '23',
            'citta' => 'Roma',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Cavour',
            'numero_civico' => '27',
            'citta' => 'Taranto',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Manfredi',
            'numero_civico' => '3',
            'citta' => 'Bari',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Cavalli',
            'numero_civico' => '12',
            'citta' => 'Bari',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Zanotti',
            'numero_civico' => '34',
            'citta' => 'Napoli',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('indirizzi')->insert([
            'via' => 'Via Giulio Cesare',
            'numero_civico' => '54',
            'citta' => 'Roma',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);
    }
}
