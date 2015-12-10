<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Curema\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@curema.local',
            'password' => bcrypt('password'),
        ]);

        factory(Curema\Models\User::class, 49)->create();
    }
}
