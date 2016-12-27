<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
        	[
        		'name' => 'admin',
        		'display_name' => 'Site Administrator'
        	],
        	[
        		'name' => 'employer',
        		'display_name' => 'Employer'
        	],
        	[
        		'name' => 'employee',
        		'display_name' => 'Employee'
        	],
        ];

        foreach ($role as $key => $value) {
        	Role::create($value);
        }
    }
}
