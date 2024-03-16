<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'company-manage' => 'Company Manage',
            'job-manage' => 'Job Manage',
            'job-delete' => 'Job Manage',
            'job-reject' => 'Job Manage',
            
            'employee-manage' => 'Employee Manage',
            'employee-delete' => 'Employee Manage',
            'employee-create' => 'Employee Manage',
            'employee-update' => 'Employee Manage',

            'blog-create' => 'Blog Manage',
            'blog-read' => 'Blog Manage',
            'blog-update' => 'Blog Manage',
            'blog-delete' => 'Blog Manage',

            'page-create' => 'Page Manage',
            'page-read' => 'Page Manage',
            'page-update' => 'Page Manage',
            'page-delete' => 'Page Manage',

            'user-create' => 'User Manage',
            'user-read' => 'User Manage',
            'user-update' => 'User Manage',
            'user-delete' => 'User Manage',

            'setting-manage' => 'Setting Manage',

        ];

        foreach ($permissions as $key => $value) {
            Permission::create([
                'name' => $key,
                'guard_name'=>'sanctum',
                'category' => $value
            ]);
        }
    }
}
