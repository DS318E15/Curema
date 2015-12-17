<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(AccountTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        $this->call(LeadTableSeeder::class);
        $this->call(OpportunityTableSeeder::class);
        $this->call(OpportunityStageTableSeeder::class);
        $this->call(TicketTableSeeder::class);

        Model::reguard();
    }
}
