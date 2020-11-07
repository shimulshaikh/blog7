<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
              DB::table('users')->truncate(); 
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
        	'name' => 'Admin user',
        	'email' => 'admin@gmail.com',
        	'password' => Hash::make('adminadmin')
        ]);

        $author = User::create([
        	'name' => 'Author user',
        	'email' => 'author@gmail.com',
        	'password' => Hash::make('authorauthor')
        ]);

        $user = User::create([
        	'name' => 'Generic user',
        	'email' => 'user@gmail.com',
        	'password' => Hash::make('useruser')
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
    }
}
