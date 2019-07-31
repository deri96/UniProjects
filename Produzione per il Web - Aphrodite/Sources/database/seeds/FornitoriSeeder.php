<?php

use Illuminate\Database\Seeder;

class FornitoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fornitori')->insert([
            'partita_iva' => '02956875212',
            'nome' => 'Enel Energia',
            'ragione_sociale' => 'SPA',
            'indirizzo_id' => '11',
            'tipo_fornitura' => 'Energia',
            'numero_telefono' => '0998878985',
            'email' => 'enelenergia@gmail.com',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('fornitori')->insert([
            'partita_iva' => '04956343845',
            'nome' => 'GasApulia',
            'ragione_sociale' => 'SPA',
            'indirizzo_id' => '12',
            'tipo_fornitura' => 'Gas',
            'numero_telefono' => '0992549398',
            'email' => 'gasapulia@libero.it',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('fornitori')->insert([
            'partita_iva' => '06855648985',
            'nome' => 'Acquedotto Pugliese',
            'ragione_sociale' => 'SRL',
            'indirizzo_id' => '13',
            'tipo_fornitura' => 'Acqua',
            'numero_telefono' => '0998795645',
            'email' => 'acp@yahoo.com',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);
    }
}
