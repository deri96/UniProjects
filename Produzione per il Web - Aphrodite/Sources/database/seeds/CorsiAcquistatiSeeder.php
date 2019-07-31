<?php

use Illuminate\Database\Seeder;

class CorsiAcquistatiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('corsi_acquistati')->insert([
            'pacchetto_acquistato' => '4',
            'data_inizio_corso'=> date('Y-m-d',strtotime('2018-05-12')),
            'data_fine_corso'=> date('Y-m-d',strtotime('2018-08-12')),
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('corsi_acquistati')->insert([
            'pacchetto_acquistato' => '8',
            'data_inizio_corso'=> date('Y-m-d',strtotime('2018-07-21')),
            'data_fine_corso'=> date('Y-m-d',strtotime('2018-10-21')),
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);

        DB::table('corsi_acquistati')->insert([
            'pacchetto_acquistato' => '10',
            'data_inizio_corso'=> date('Y-m-d',strtotime('2018-01-04')),
            'data_fine_corso'=> date('Y-m-d',strtotime('2018-06-04')),
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')]);
    }
}
