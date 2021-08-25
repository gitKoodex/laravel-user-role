<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Role();
        $role1->name = 'role_visitor';
        $role1->description = "mahallo user";
        $role1->save();


        $role2 = new Role();
        $role2->name = 'role_admin';
        $role2->description = "mahallow desc";
        $role2->save();
    }
}
