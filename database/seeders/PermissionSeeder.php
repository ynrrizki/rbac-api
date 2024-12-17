<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'editor',
            'viewer',
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create(['name' => $role]);
        }

        $permissions = [
            'create post',
            'edit post',
            'delete post',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        $role = \Spatie\Permission\Models\Role::findByName('admin');
        $role->givePermissionTo('create post', 'edit post', 'delete post');


        $role = \Spatie\Permission\Models\Role::findByName('editor');
        $role->givePermissionTo('create post', 'edit post');

        $role = \Spatie\Permission\Models\Role::findByName('viewer');
        $role->givePermissionTo('view post');

        $user = \App\Models\User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }

        $user = \App\Models\User::find(2);
        if ($user) {
            $user->assignRole('editor');
        }

        $user = \App\Models\User::find(3);
        if ($user) {
            $user->assignRole('viewer');
        }
    }
}
