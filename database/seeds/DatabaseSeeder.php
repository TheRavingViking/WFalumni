<?php
use App\Role;
use App\User;
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
        $this->call(add_opleiding::class);
        $this->call(add_bedrijf::class);
        $this->call(add_woonplaats::class);
        $this->call(add_richtingen::class);
        $this->call(add_opleidingen::class);

        factory(App\User::class, 200)
            ->create()
            ->each(function($o) {$o->opleiding()->save(factory(App\Opleiding::class, 1)
                ->make());})
            ->each(function($b) {$b->Bedrijf()->saveMany(factory(App\Bedrijf::class, 2)
                ->make());})
            ->each(function($w) {$w->Woonplaats()->saveMany(factory(App\Woonplaats::class, 2)
                ->make());});

    }
}
