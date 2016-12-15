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

        $this->call(add_role::class); //MOET BOVEN users!!! - Laurens

                factory(App\User::class, 200)
            ->create()
            ->each(function($o) {$o->opleiding()->save(factory(App\Opleiding::class, 1)
                ->make());})
            ->each(function($b) {$b->Bedrijf()->saveMany(factory(App\Bedrijf::class, 2)
                ->make());})
            ->each(function($w) {$w->Woonplaats()->saveMany(factory(App\Woonplaats::class, 2)
                ->make());});
//            ->each(function($a) {$a->user_role()->save(factory(App\user_role::class, 1)   <-----Conflict met usertabel!! -Laurens
//                ->make());});

//        $this->call(add_user::class);
//        $this->call(add_opleiding::class);
//        $this->call(add_bedrijf::class);
//        $this->call(add_woonplaats::class);


//        $this->call(add_real_user::class);
//        $this->call(add_real_opleiding::class);
//        $this->call(add_real_bedrijf::class);
//        $this->call(add_real_woon::class);

        $this->call(add_user::class);
        $this->call(add_opleiding::class);
        $this->call(add_bedrijf::class);
        $this->call(add_woonplaats::class);

        $this->call(add_richtingen::class);
        $this->call(add_opleidingen::class);




    }
}
