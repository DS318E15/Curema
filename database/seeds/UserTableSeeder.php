<?php

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Curema\Models\User;
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
        // roles
        $superiorRole = Role::create([
            'name' => 'Superior',
            'slug' => 'superior',
        ]);

        $salespersonRole = Role::create([
            'name' => 'Salesperson',
            'slug' => 'salesperson',
        ]);

        $supporterRole = Role::create([
            'name' => 'Supporter',
            'slug' => 'supporter',
        ]);

        $editUsersPermission = Permission::create([
            'name' => 'Edit users',
            'slug' => 'edit.users',
        ]);

        $viewLeadsPermission = Permission::create([
            'name' => 'View leads',
            'slug' => 'view.leads',
        ]);

        $viewOpportunityPermission = Permission::create([
            'name' => 'View opportunities',
            'slug' => 'view.opportunities',
        ]);

        // assing permissions to roles
        $superiorRole->attachPermission($editUsersPermission);
        $superiorRole->attachPermission($viewLeadsPermission);
        $superiorRole->attachPermission($viewOpportunityPermission);

        $salespersonRole->attachPermission($viewLeadsPermission);
        $salespersonRole->attachPermission($viewOpportunityPermission);

        $user = User::create([
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
        $user->attachRole($superiorRole);

        $user = User::create([
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
        $user->attachRole($salespersonRole);

        $user = User::create([
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
        $user->attachRole($supporterRole);

        factory(Curema\Models\User::class, 27)->create();
    }
}
