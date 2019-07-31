<?php

use Illuminate\Database\Seeder;

class InsegnantiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tessere')->insert(['nome' => 'Germana',
            'cognome' => 'Clemente',
            'indirizzo_id' => '2',
            'sesso' => '0',
            'luogo_nascita' => 'Roma',
            'data_nascita' => date('Y-m-d',strtotime( '1987-05-18')),
            'data_iscrizione' => date('Y-m-d',strtotime( '2018-04-03')),
            'scadenza' => date('Y-m-d',strtotime( '2019-04-03')),
            'numero_telefono' => '3395478522',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-04-03 14:21:23')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime( '2018-04-03')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-04-03')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-04-03')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2018-10-03')),
            'ruolo_societario' => 'direttore',
            'ruolo_sportivo' => 'insegnante',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('tessere')->insert(['nome' => 'Giulio',
            'cognome' => 'Notaristefano',
            'indirizzo_id' => '3',
            'sesso' => '1',
            'luogo_nascita' => 'Pescara',
            'data_nascita' => date('Y-m-d',strtotime( '1976-06-24')),
            'data_iscrizione' => date('Y-m-d',strtotime( '2018-08-09')),
            'scadenza' => date('Y-m-d',strtotime( '2019-08-09')),
            'numero_telefono' => '3335642564',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-08-09 09:59:59')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime( '2018-06-24')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-06-24')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-06-24')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2018-12-24')),
            'ruolo_societario' => 'ordinario',
            'ruolo_sportivo' => 'insegnante',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('tessere')->insert(['nome' => 'Michele',
            'cognome' => 'Bramante',
            'indirizzo_id' => '5',
            'sesso' => '1',
            'luogo_nascita' => 'Verona',
            'data_nascita' => date('Y-m-d',strtotime( '1977-08-09')),
            'data_iscrizione' => date('Y-m-d',strtotime( '2018-10-20')),
            'scadenza' => date('Y-m-d',strtotime( '2019-10-20')),
            'numero_telefono' => '3298653199',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-08-09 12:34:18')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime( '2018-10-20')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-10-20')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-10-20')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2019-04-20')),
            'ruolo_societario' => 'presidente',
            'ruolo_sportivo' => 'insegnante',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('tessere')->insert(['nome' => 'Giovanna',
            'cognome' => 'Nitro',
            'indirizzo_id' => '6',
            'sesso' => '0',
            'luogo_nascita' => 'Trieste',
            'data_nascita' => date('Y-m-d',strtotime( '1961-12-14')),
            'data_iscrizione' => date('Y-m-d',strtotime( '2018-05-21')),
            'scadenza' => date('Y-m-d',strtotime( '2019-05-21')),
            'numero_telefono' => '3852165655',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-05-21 11:12:43')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime( '2018-05-21')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-05-21')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-05-21')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2018-11-21')),
            'ruolo_societario' => 'vicepresidente',
            'ruolo_sportivo' => 'nessuno',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('tessere')->insert(['nome' => 'Vito',
            'cognome' => 'Patruno',
            'indirizzo_id' => '7',
            'sesso' => '1',
            'luogo_nascita' => 'Napoli',
            'data_nascita' => date('Y-m-d',strtotime( '1991-08-08')),
            'data_iscrizione' => date('Y-m-d',strtotime( '2018-04-11')),
            'scadenza' => date('Y-m-d',strtotime( '2019-04-11')),
            'numero_telefono' => '3459862933',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-04-11 08:14:32')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime( '2018-04-11')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-04-11')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-04-11')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2018-10-11')),
            'ruolo_societario' => 'dirigente',
            'ruolo_sportivo' => 'nessuno',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('tessere')->insert(['nome' => 'Federica',
            'cognome' => 'Lassandri',
            'indirizzo_id' => '8',
            'sesso' => '0',
            'luogo_nascita' => 'Viterbo',
            'data_nascita' => date('Y-m-d',strtotime('1991-11-29')),
            'data_iscrizione' => date('Y-m-d',strtotime( '2018-02-18')),
            'scadenza' => date('Y-m-d',strtotime( '2019-02-18')),
            'numero_telefono' => '3254543244',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-02-18 15:23:12')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime( '2018-02-18')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-02-18')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-02-18')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2018-08-18')),
            'ruolo_societario' => 'ordinario',
            'ruolo_sportivo' => 'insegnante',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('tessere')->insert(['nome' => 'Giovanni',
            'cognome' => 'Dileo',
            'indirizzo_id' => '9',
            'sesso' => '1',
            'luogo_nascita' => 'Caserta',
            'data_nascita' => date('Y-m-d',strtotime( '1945-06-24')),
            'data_iscrizione' => date('Y-m-d',strtotime( '2018-07-14')),
            'scadenza' => date('Y-m-d',strtotime( '2019-07-14')),
            'numero_telefono' => '3598852566',
            'numero_assicurazione' => date('YmdHis', strtotime('2018-07-14 21:10:04')),
            'data_inizio_assicurazione' => date('Y-m-d',strtotime( '2018-07-14')),
            'data_fine_assicurazione' => date('Y-m-d',strtotime( '2019-07-14')),
            'data_inizio_certificato_medico' => date('Y-m-d',strtotime( '2018-07-14')),
            'data_fine_certificato_medico' => date('Y-m-d',strtotime( '2019-01-14')),
            'ruolo_societario' => 'collaboratore',
            'ruolo_sportivo' => 'insegnante',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);


    }
}
