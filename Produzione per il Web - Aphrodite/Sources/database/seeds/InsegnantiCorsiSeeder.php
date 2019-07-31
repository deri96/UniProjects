<?php

use Illuminate\Database\Seeder;

class InsegnantiCorsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('corsi')->where('id', '1')->update([
            'insegnante_id' => 'CMNGRM87E58H501G',
            ]);

        DB::table('corsi')->where('id', '2')->update([
            'stagista_id' => 'KLDKLD67D21Z100Q',
        ]);

        DB::table('corsi')->where('id', '3')->update([
            'insegnante_id' => 'CMNGRM87E58H501G',
        ]);

        DB::table('corsi')->where('id', '4')->update([
            'insegnante_id' => 'NRSGLI76H24G482H',
        ]);

        DB::table('corsi')->where('id', '5')->update([
            'insegnante_id' => 'BMNMCH77M09L781M',
        ]);

        DB::table('corsi')->where('id', '6')->update([
            'insegnante_id' => 'BMNMCH77M09L781M',
        ]);

        DB::table('corsi')->where('id', '7')->update([
            'insegnante_id' => 'BMNMCH77M09L781M',
        ]);
    }
}
