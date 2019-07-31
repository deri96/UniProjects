<?php

use Illuminate\Database\Seeder;

class CorsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('corsi')->insert([
            'nome' => 'Danza moderna',
            'costo'=> '7.50',
            'disciplina_id' => '1',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('corsi')->insert([
            'nome' => 'Danza classica',
            'costo' => '13.50',
            'disciplina_id' => '1',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('corsi')->insert([
            'nome' => 'Pizzica e tarantella',
            'costo' => '4.50',
            'disciplina_id' => '1',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('corsi')->insert([
            'nome' => 'Ginnastica artistica',
            'costo' => '10.50',
            'disciplina_id' => '5',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('corsi')->insert([
            'nome' => 'Sala pesi',
            'costo' => '3.50',
            'disciplina_id' => '7',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('corsi')->insert([
            'nome' => 'Aerobica',
            'costo' => '5.50',
            'disciplina_id' => '5',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);

        DB::table('corsi')->insert([
            'nome' => 'Crossfit',
            'costo' => '8.50',
            'disciplina_id' => '3',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')]);
    }
}
