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
            'name' => 'Rasmus Nørskov',
            'title' => 'CEO',
            'street_name' => 'Hobrovej',
            'street_number' => '77 st',
            'city' => 'Aalborg',
            'zip' => '9000',
            'country' => 'Danmark',
            'phone' => '+45 50 72 47 29',
            'email' => 'rnarsk14@student.aau.dk',
            'password' => bcrypt('password'),
        ]);

        \Curema\Models\User::create([
            'name' => 'Andreas Sommerset',
            'title' => 'Intern',
            'street_name' => 'Ribevej',
            'street_number' => '3, 1. 89',
            'city' => 'Aalborg Ø',
            'zip' => '9220',
            'country' => 'Danmark',
            'phone' => '+45 41 19 43 29',
            'email' => 'asomme14@student.aau.dk',
            'password' => bcrypt('password'),
        ]);

        \Curema\Models\User::create([
            'name' => 'Nicklas Embo',
            'title' => 'Office Assistant',
            'street_name' => 'Henning Smiths Vej',
            'street_number' => '21, 3',
            'city' => 'Aalborg',
            'zip' => '9000',
            'country' => 'Danmark',
            'phone' => '+45 30 95 55 11',
            'email' => 'nembo14@student.aau.dk',
            'password' => bcrypt('password'),
        ]);

        factory(Curema\Models\User::class, 49)->create();
    }
}
