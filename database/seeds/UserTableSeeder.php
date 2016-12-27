<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
        	[
        		'name' => 'Administrator',
        		'email' => 'admin@job-finder.net',
        		'password' => bcrypt('adminpassword')
        	],
        	[
        		'name' => 'Employer',
        		'email' => 'employer@job-finder.net',
        		'password' => bcrypt('employerpassword')
        	],
        	[
        		'name' => 'Employee',
        		'email' => 'employee@job-finder.net',
        		'password' => bcrypt('employeepassword')
        	]
        ];

        foreach ($user as $key => $value) {
        	User::create($value);
        }
    }
}
