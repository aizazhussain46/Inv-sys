<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = array('Admin','Inventory','Budget');
        foreach($roles as $role){
            \DB::table('roles')->insert([
                'role' => $role
            ]);
        }

         \DB::table('links')->insert([
            'url' => 'https://devinv.efulife.com/'
        ]);

        

        \DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret') ,
            'role_id' => 1
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
