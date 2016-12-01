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
        $this->call(add_user::class);
        $this->call(add_bedrijf::class);
        $this->call(add_woonplaats::class);
        $this->call(add_opleiding::class);
    }
}
