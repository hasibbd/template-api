<?php

namespace Database\Seeders;

use App\Models\Configuration\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Name',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
            'role' => 1,
        ]);
        Menu::insert([
            'text' => 'Dashboard',
            'href' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'target' => '_self',
            'title' => 'Dashboard'
        ],[
            'text' => 'Menu List',
            'href' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'target' => '_self',
            'title' => 'Menu List'
        ], [
            'text' => 'User List',
            'href' => 'user-list',
            'icon' => 'fas fa-users',
            'target' => '_self',
            'title' => 'User List'
        ], [
            'text' => 'Role List',
            'href' => 'role',
            'icon' => 'fas fa-users',
            'target' => '_self',
            'title' => 'Role List'
        ]);
    }
}
