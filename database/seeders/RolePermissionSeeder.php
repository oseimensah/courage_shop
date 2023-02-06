<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('roles')->get()->count() == 0) {

            $roles =  [
                [
                    'name' => 'super_admin',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'admin',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'customer',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            foreach ($roles as $role) {
                DB::table('roles')->insert($role);
            }
        }

        // if (DB::table('permissions')->get()->count() == 0) {
        //     $permissions = [];
        // }
    }
}
