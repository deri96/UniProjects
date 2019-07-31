<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SaleSeeder::class);
        $this->call(DisciplineSeeder::class);
        $this->call(IndirizziSeeder::class);
        $this->call(InsegnantiSeeder::class);
        $this->call(FornitoriSeeder::class);
        $this->call(StagistiSeeder::class);
        $this->call(CorsiSeeder::class);
        $this->call(PacchettiSeeder::class);
        $this->call(CorsiAcquistatiSeeder::class);
        $this->call(AllieviSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SociSeeder::class);
        $this->call(InsegnantiCorsiSeeder::class);
        $this->call(CalendariSeeder::class);
        $this->call(TransazioniSeeder::class);

    }
}
