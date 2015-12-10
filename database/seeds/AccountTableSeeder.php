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
        factory(Curema\Models\App\Account::class, 5)->create();
    }
}
