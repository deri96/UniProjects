<?php

use Illuminate\Database\Seeder;

class StagistiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stagisti')->insert([
            'codice_fiscale' => 'MGLMHL75B15H501U',
            'nome' => 'Michele',
            'cognome' => 'Magalli',
            'indirizzo_id' => '14',
            'sesso' => '1',
            'luogo_nascita' => 'Roma',
            'data_nascita' => '1975-02-15',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('stagisti')->insert([
            'codice_fiscale' => 'FMRPLA70L65F839K',
            'nome' => 'Paola',
            'cognome' => 'Fumarola',
            'indirizzo_id' => '15',
            'sesso' => '0',
            'luogo_nascita' => 'Napoli',
            'data_nascita' => '1970-07-25',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('stagisti')->insert([
            'codice_fiscale' => 'KLDKLD67D21Z100Q',
            'nome' => 'Kledi',
            'cognome' => 'Kladiu',
            'indirizzo_id' => '16',
            'sesso' => '1',
            'luogo_nascita' => 'Tirana',
            'data_nascita' => '1967-04-21',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);


    }
}
