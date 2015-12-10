<?php

use Curema\Models\App\Account;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'name' => 'Apple',
        ]);

        Account::create([
            'name' => 'Google',
        ]);

        Account::create([
            'name' => 'Microsoft',
        ]);

        Account::create([
            'name' => 'Intel',
        ]);

        Account::create([
            'name' => 'Samsung',
        ]);

        Account::create([
            'name' => 'IBM',
        ]);
    }
}
