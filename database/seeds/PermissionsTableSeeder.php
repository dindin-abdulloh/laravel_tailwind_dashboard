<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'project_create',
            ],
            [
                'id'    => 18,
                'title' => 'project_edit',
            ],
            [
                'id'    => 19,
                'title' => 'project_show',
            ],
            [
                'id'    => 20,
                'title' => 'project_delete',
            ],
            [
                'id'    => 21,
                'title' => 'project_access',
            ],
            [
                'id'    => 22,
                'title' => 'folder_create',
            ],
            [
                'id'    => 23,
                'title' => 'folder_edit',
            ],
            [
                'id'    => 24,
                'title' => 'folder_show',
            ],
            [
                'id'    => 25,
                'title' => 'folder_delete',
            ],
            [
                'id'    => 26,
                'title' => 'folder_access',
            ],
            [
                'id'    => 27,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 28,
                'title' => 'products_access',
            ],
            [
                'id'    => 29,
                'title' => 'products_create',
            ],
            [
                'id'    => 30,
                'title' => 'products_delete',
            ],
            [
                'id'    => 31,
                'title' => 'products_show',
            ],
            [
                'id'    => 32,
                'title' => 'products_edit',
            ],

            // categories
            [
                'id'    => 33,
                'title' => 'categories_access',
            ],
            [
                'id'    => 34,
                'title' => 'categories_create',
            ],
            [
                'id'    => 35,
                'title' => 'categories_delete',
            ],
            [
                'id'    => 36,
                'title' => 'categories_show',
            ],
            [
                'id'    => 37,
                'title' => 'categories_edit',
            ],
            // suppliers
            [
                'id'    => 38,
                'title' => 'suppliers_access',
            ],
            [
                'id'    => 39,
                'title' => 'suppliers_create',
            ],
            [
                'id'    => 40,
                'title' => 'suppliers_delete',
            ],
            [
                'id'    => 41,
                'title' => 'suppliers_show',
            ],
            [
                'id'    => 42,
                'title' => 'suppliers_edit',
            ],
            // sales
            [
                'id'    => 43,
                'title' => 'sales_access',
            ],
            [
                'id'    => 44,
                'title' => 'sales_create',
            ],
            [
                'id'    => 45,
                'title' => 'sales_delete',
            ],
            [
                'id'    => 46,
                'title' => 'sales_show',
            ],
            [
                'id'    => 47,
                'title' => 'sales_edit',
            ],
            [
                'id'    => 48,
                'title' => 'sales_print',
            ],
            // units
            [
                'id'    => 49,
                'title' => 'units_access',
            ],
            [
                'id'    => 50,
                'title' => 'units_create',
            ],
            [
                'id'    => 51,
                'title' => 'units_delete',
            ],
            [
                'id'    => 52,
                'title' => 'units_show',
            ],
            [
                'id'    => 53,
                'title' => 'units_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
