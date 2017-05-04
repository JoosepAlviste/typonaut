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
        factory('App\User')->create([
            'name' => 'Joosep',
            'email' => 'joosep@email.ee',
        ]);
        factory('App\User')->create([
            'name' => 'Brenda',
            'email' => 'brenda@email.ee',
        ]);
    }
}
