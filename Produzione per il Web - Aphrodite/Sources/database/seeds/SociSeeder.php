<?php

use Illuminate\Database\Seeder;

class SociSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('soci')->insert(['codice_fiscale' => 'CMNGRM87E58H501G',
            'tessera_id' => '1',
            'utente_id' => '2',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('soci')->insert(['codice_fiscale' => 'NRSGLI76H24G482H',
            'tessera_id' => '2',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('soci')->insert(['codice_fiscale' => 'BMNMCH77M09L781M',
            'tessera_id' => '3',
            'utente_id' => '4',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('soci')->insert(['codice_fiscale' => 'NTRGVN61T54L424T',
            'tessera_id' => '4',
            'utente_id' => '5',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('soci')->insert(['codice_fiscale' => 'PRNVTI91M08F839J',
            'tessera_id' => '5',
            'utente_id' => '6',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('soci')->insert(['codice_fiscale' => 'LSNFDR91B69M082F',
            'tessera_id' => '6',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('soci')->insert(['codice_fiscale' => 'DLIGVN45H24B963S',
            'tessera_id' => '7',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('soci')->insert(['codice_fiscale' => 'PMSTHM98T14L219Z',
            'tessera_id' => '8',
            'utente_id' => '1',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('soci')->insert(['codice_fiscale' => 'LBNTRS99T47L049N',
            'tessera_id' => '9',
            'utente_id' => '3',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('soci')->insert(['codice_fiscale' => 'MNSLRA72M43B519A',
            'tessera_id' => '10',
            'utente_id' => '7',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
    }
}
