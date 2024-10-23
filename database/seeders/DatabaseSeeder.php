<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RolePermissionSeeder::class);

        $user = User::factory()->create([
            'firstname' => 'John',
            'lastname' => 'Editor',
            'email' => 'editor@gmail.com',
            'status' => 'Active',
            'password' => Hash::make('password')
        ]);

        $role = Role::findByName('Editor');
        $user->assignRole($role);
    }
}
