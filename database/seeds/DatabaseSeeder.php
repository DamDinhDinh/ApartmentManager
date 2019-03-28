<?php

use Illuminate\Database\Seeder;
use App\Apartment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(App\Apartment::class, 50)->create();
        factory(App\User::class, 50)->create();
    }
}
