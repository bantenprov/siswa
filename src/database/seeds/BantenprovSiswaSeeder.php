<?php

use Illuminate\Database\Seeder;

class BantenprovSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(BantenprovSiswaSeederSiswa::class);
    }
}
