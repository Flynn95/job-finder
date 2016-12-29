<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
	            'name' => 'General'
	        ],
        	[
	            'name' => 'Architecture and Engineering'
	        ],
	        [
	        	'name' => 'Arts, Design, and Media'
	        ],
	        [
	        	'name' => 'Building Maintenance'
	        ],
	        [
	        	'name' => 'Business and Financial Operations'
	        ],
	        [
	        	'name' => 'Community and Social Service'
	        ],
	        [
	        	'name' => 'Construction'
	        ],
	        [
	        	'name' => 'Education'
	        ],
	        [
	        	'name' => 'Farming, Fishing, and Forestry'
	        ],
	        [
	        	'name' => 'Food Services'
	        ],
	        [
	        	'name' => 'Healthcare Practitioners and Technical'
	        ],
	        [
	        	'name' => 'Healthcare Support'
	        ],
	        [
	        	'name' => 'Installation, Maintenance, and Repair'
	        ],
	        [
	        	'name' => 'Legal'
	        ],
	        [
	        	'name' => 'Life, Physical, and Social Science'
	        ],
	        [
	        	'name' => 'Management'
	        ],
	        [
	        	'name' => 'Manufacturing and Production'
	        ],
	        [
	        	'name' => 'Office and Administrative Support'
	        ],
	        [
	        	'name' => 'Personal Care and Service'
	        ],
	        [
	        	'name' => 'Protective Services'
	        ],
	        [
	        	'name' => 'Sales'
	        ],
	        [
	        	'name' => 'Technology'
	        ],
	        [
	        	'name' => 'Transportation and Moving'
	        ]
	    ];

	    foreach ($data as $key => $value) {
	    	DB::table('categories')->insert($value);
	    }
    }
}
