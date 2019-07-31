<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'tessera_id' => '8',
            'email' => 'thohohomas@libero.it',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('12345678'),
            'tipo_admin' => 'utente',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'tessera_id' => '1',
            'email' => 'germanaclemente@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('12345678'),
            'tipo_admin' => 'admin',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'tessera_id' => '9',
            'email' => 'terryalbano@libero.it',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('12345678'),
            'tipo_admin' => 'utente',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'tessera_id' => '3',
            'email' => 'bramantis@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('12345678'),
            'tipo_admin' => 'admin',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'tessera_id' => '4',
            'email' => 'nitroglicerina@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('12345678'),
            'tipo_admin' => 'admin',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'tessera_id' => '5',
            'email' => 'vitopatruno@hotmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('12345678'),
            'tipo_admin' => 'admin',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'tessera_id' => '10',
            'email' => 'laramanisi@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('12345678'),
            'tipo_admin' => 'utente',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'tessera_id' => '7',
            'email' => 'dileoncino@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt(str_random(12)),
            'tipo_admin' => ' ',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'tessera_id' => '6',
            'email' => 'fedelassandri@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt(str_random(12)),
            'tipo_admin' => 'utente',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'tessera_id' => '2',
            'email' => 'notarigiulio@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt(str_random(12)),
            'tipo_admin' => 'utente',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
    }
}
