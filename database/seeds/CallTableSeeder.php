<?php

use Illuminate\Database\Seeder;

class CallTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Curema\Models\App\Call::class, 10)->create();
    }
}
