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
            ->each(function($b) {$b->Bedrijf()->save(factory(App\Bedrijf::class, 1)
                ->make());})
            ->each(function($w) {$w->Woonplaats()->save(factory(App\Woonplaats::class, 1)
                ->make());});

    }
}
