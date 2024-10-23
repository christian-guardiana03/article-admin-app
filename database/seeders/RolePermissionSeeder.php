<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $editor = Role::create(['name' => 'Editor']);
        $writer = Role::create(['name' => 'Writer']);

        Permission::create(['name' => 'create article']);
        Permission::create(['name' => 'edit unpublish article']);
        Permission::create(['name' => 'edit article']);
        Permission::create(['name' => 'publish article']);
        Permission::create(['name' => 'manage user']);
        Permission::create(['name' => 'manage company']);

        $editor->givePermissionTo('edit article');
        $editor->givePermissionTo('publish article');
        $editor->givePermissionTo('manage user');
        $editor->givePermissionTo('manage company');

        $writer->givePermissionTo('create article');
        $writer->givePermissionTo('edit unpublish article');
    }
}
