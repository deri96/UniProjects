<?php

use Illuminate\Database\Seeder;

class TransazioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20190108111412',
            'tipo_documento_fiscale' => 'ricevuta_numerata',
            'importo' => '65',
            'causale' => 'Rinnovo del corso',
            'data_erogazione' => date('Y-m-d', strtotime('2019-01-08')),
            'modalita_pagamento' => 'bonifico',
            'in_entrata' => '1',
            'codice_fiscale_soggetto_transazione' => 'PMSTHM98T14L219Z',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20190113162727',
            'tipo_documento_fiscale' => 'ricevuta_fiscale',
            'importo' => '160',
            'causale' => 'Iscrizione al corso',
            'data_erogazione' => date('Y-m-d', strtotime('2019-01-13')),
            'modalita_pagamento' => 'contanti',
            'in_entrata' => '1',
            'codice_fiscale_soggetto_transazione' => 'MNSLRA72M43B519A',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20190108181512',
            'tipo_documento_fiscale' => 'ricevuta_fiscale',
            'importo' => '10',
            'causale' => 'Rinnovo della tessera',
            'data_erogazione' => date('Y-m-d', strtotime('2019-01-08')),
            'modalita_pagamento' => 'contanti',
            'in_entrata' => '1',
            'codice_fiscale_soggetto_transazione' => 'PMSTHM98T14L219Z',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20181120211412',
            'tipo_documento_fiscale' => 'fattura',
            'importo' => '10',
            'causale' => 'Rinnovo dell\'assicurazione',
            'data_erogazione' => date('Y-m-d', strtotime('2018-11-20')),
            'modalita_pagamento' => 'contanti',
            'in_entrata' => '1',
            'codice_fiscale_soggetto_transazione' => 'MNSLRA72M43B519A',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20190202130202',
            'tipo_documento_fiscale' => 'ricevuta',
            'importo' => '21',
            'causale' => 'Rinnovo del corso',
            'data_erogazione' => date('Y-m-d', strtotime('2019-02-02')),
            'modalita_pagamento' => 'contanti',
            'in_entrata' => '1',
            'codice_fiscale_soggetto_transazione' => 'MNSLRA72M43B519A',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20181228183412',
            'tipo_documento_fiscale' => 'ricevuta',
            'importo' => '65',
            'causale' => 'Pagamento dell\'insegnante',
            'data_erogazione' => date('Y-m-d', strtotime('2018-12-28')),
            'modalita_pagamento' => 'bancomat',
            'in_entrata' => '0',
            'codice_fiscale_soggetto_transazione' => 'DLIGVN45H24B963S',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20190108182259',
            'tipo_documento_fiscale' => 'ricevuta_numerata',
            'importo' => '68',
            'causale' => 'Rinnovo del corso',
            'data_erogazione' => date('Y-m-d', strtotime('2019-02-10')),
            'modalita_pagamento' => 'paypal',
            'in_entrata' => '1',
            'codice_fiscale_soggetto_transazione' => 'PMSTHM98T14L219Z',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20190212103333',
            'tipo_documento_fiscale' => 'ricevuta_numerata',
            'importo' => '116.20',
            'causale' => 'Pagamento del fornitore',
            'data_erogazione' => date('Y-m-d', strtotime('2019-02-12')),
            'modalita_pagamento' => 'bonifico',
            'in_entrata' => '0',
            'partita_iva_soggetto_transazione_id' => '02956875212',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20190213122412',
            'tipo_documento_fiscale' => 'fattura',
            'importo' => '412.39',
            'causale' => 'Pagamento del fornitore',
            'data_erogazione' => date('Y-m-d', strtotime('2019-02-13')),
            'modalita_pagamento' => 'bonifico',
            'in_entrata' => '0',
            'partita_iva_soggetto_transazione_id' => '04956343845',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('transazioni')->insert([
            'numero_documento_fiscale' => '20190218213412',
            'tipo_documento_fiscale' => 'fattura',
            'importo' => '354.35',
            'causale' => 'Pagamento del fornitore',
            'data_erogazione' => date('Y-m-d', strtotime('2019-02-18')),
            'modalita_pagamento' => 'bonifico',
            'in_entrata' => '0',
            'partita_iva_soggetto_transazione_id' => '06855648985',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
    }
}
