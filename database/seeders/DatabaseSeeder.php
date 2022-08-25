<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\Admin;
use App\Models\AdminUser;
use Illuminate\Support\Str;
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
        // \App\Models\User::factory(10)->create();



  



        //super admin date
        AdminUser::create([
            'name'              =>'Provider',
            'email'             =>'provider@gmail.com',
            'cell'              =>'01937793487',
            'username'          =>'provider',
            'password'          =>Hash::make('123456789'),
            'photo'             =>'avatar.png',
        ]);
    }
}
