<?php

use Illuminate\Database\Seeder;

class AllieviSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tessere')->insert(['nome' => 'Thomas',
            'cognome' => 'Palmisano',
            'indirizzo_id' => '1',
            'sesso' => '1',
            'luogo_nascita' => 'Torino',
            'data_nascita' => date('Y-m-d',strtotime('1998-12-14')),
            'data_iscrizione' => date('Y-m-d',strtotime('2018-09-05')),
            'scadenza' => date('Y-m-d',strtotime('2019-09-05')),
            'numero_telefono' => '3459862933',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-09-05 18:32:12')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime('2018-09-05')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-09-05')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-09-05')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2019-03-05')),
            'ruolo_societario' => 'ordinario',
            'ruolo_sportivo' => 'allievo',
            'corso_acquistato' => '1',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('tessere')->insert(['nome' => 'Teresa',
            'cognome' => 'Albano',
            'indirizzo_id' => '4',
            'sesso' => '0',
            'luogo_nascita' => 'Taranto',
            'data_nascita' => date('Y-m-d',strtotime( '1999-12-07')),
            'data_iscrizione' => date('Y-m-d',strtotime( '2018-01-05')),
            'scadenza' => date('Y-m-d',strtotime( '2019-01-05')),
            'numero_telefono' => '3895353116',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-01-05 21:00:02')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime( '2018-01-05')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-01-05')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-01-05')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2018-07-05')),
            'ruolo_societario' => 'ordinario',
            'ruolo_sportivo' => 'allievo',
            'corso_acquistato' => '2',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);



        DB::table('tessere')->insert(['nome' => 'Lara',
            'cognome' => 'Manisi',
            'indirizzo_id' => '10',
            'sesso' => '0',
            'luogo_nascita' => 'Campobasso',
            'data_nascita' => date('Y-m-d',strtotime( '1972-08-03')),
            'data_iscrizione' => date('Y-m-d',strtotime( '2018-01-02')),
            'scadenza' => date('Y-m-d',strtotime( '2019-01-02')),
            'numero_telefono' => '3482564828',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-01-02 11:46:42')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime( '2018-01-12')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-01-12')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-01-12')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2018-07-12')),
            'ruolo_societario' => 'ordinario',
            'ruolo_sportivo' => 'allievo',
            'corso_acquistato' => '3',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

    }
}
