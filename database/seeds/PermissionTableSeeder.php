<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
        	[
        		'name' => 'post-manage',
        		'display_name' => 'Display Post Manage page',
        		'description' => 'See Manage page Of Posts'
        	],
        	[
        		'name' => 'post-create',
        		'display_name' => 'Create Post',
        		'description' => 'Create New Post'
        	],
        	[
        		'name' => 'post-edit',
        		'display_name' => 'Edit Post',
        		'description' => 'Edit Post'
        	],
        	[
        		'name' => 'post-delete',
        		'display_name' => 'Delete Post',
        		'description' => 'Delete Post'
        	],
        	[
        		'name' => 'category-manage',
        		'display_name' => 'Display Category Manage Page',
        		'description' => 'See Manage page Of Categories'
        	],
        	[
        		'name' => 'category-create',
        		'display_name' => 'Create Category',
        		'description' => 'Create New Category'
        	],
        	[
        		'name' => 'category-edit',
        		'display_name' => 'Edit Category',
        		'description' => 'Edit Category'
        	],
        	[
        		'name' => 'category-delete',
        		'display_name' => 'Delete Category',
        		'description' => 'Delete Category'
        	]
        ];

        foreach ($permission as $key => $value) {
        	Permission::create($value);
        }
    }
}
