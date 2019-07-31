<?php

use Illuminate\Database\Seeder;

class CalendariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 17:00:00', strtotime( '+0 days')),
            'sala_id' => '1',
            'corso_id' => '1',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 17:00:00',strtotime( '+0 days')),
            'sala_id' => '2',
            'corso_id' => '2',
            'note' => 'La lezione inizia con 10 minuti di ritardo',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 18:00:00',strtotime( '+0 days')),
            'sala_id' => '3',
            'corso_id' => '5',
            'note' => 'Incontro con il nuovo istruttore',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 17:00:00',strtotime( '+0 days')),
            'sala_id' => '3',
            'corso_id' => '6',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 15:00:00',strtotime( '+0 days')),
            'sala_id' => '1',
            'corso_id' => '5',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 11:00:00',strtotime( '+0 days')),
            'sala_id' => '4',
            'corso_id' => '7',
            'note' => 'La lezione finirà prima a causa di impegni dell\'istruttore',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 10:00:00',strtotime( '+0 days')),
            'sala_id' => '4',
            'corso_id' => '2',
            'note' => 'Presiederà il maestro Filippo Galbiati',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 17:00:00',strtotime( '+1 days')),
            'sala_id' => '2',
            'corso_id' => '3',
            'note' => 'La lezione è in dubbio a causa di eventi inattesi',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 17:00:00',strtotime( '+1 days')),
            'sala_id' => '1',
            'corso_id' => '5',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 14:00:00',strtotime( '+1 days')),
            'sala_id' => '5',
            'corso_id' => '5',
            'note' => 'La lezione terminerà prima a causa di lavori da effettuare nella sala',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 18:00:00',strtotime( '+1 days')),
            'sala_id' => '2',
            'corso_id' => '4',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 09:00:00',strtotime( '+1 days')),
            'sala_id' => '2',
            'corso_id' => '6',
            'note' => 'La lezione inizierà mezz\'ora dopo a causa di impegni dell\'istruttore',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 12:00:00',strtotime( '+1 days')),
            'sala_id' => '4',
            'corso_id' => '4',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 16:00:00',strtotime( '+1 days')),
            'sala_id' => '1',
            'corso_id' => '5',
            'note' => 'Si ricorda agli allievi di munirsi del materiale necessario',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('calendari')->insert([
            'giorno_ora' => date('Y-m-d 12:00:00',strtotime( '+1 days')),
            'sala_id' => '2',
            'corso_id' => '2',
            'note' => 'Il maestro Kladiu sarà asssente per motivi di lavoro. Lo sostituirà il maestro Bramati',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);
    }
}
