<?php

namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();


        $admin = User::create([
            'first_name' => 'Lukas',
            'last_name' => 'Žilinskas',
            'email' => 'lukas.zilinskas@harmony.lt',
            'gender' => 'moteris',
            'role' => '2',
            'password' => Hash::make('password')
        ]);

        $superuser = User::create([
            'first_name' => 'Agnė',
            'last_name' => 'Admin',
            'email' => 'agne.admin@harmony.lt',
            'gender' => 'moteris',
            'role' => '1',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'first_name' => 'Tomas',
            'last_name' => 'Kazlauskas',
            'email' => 'tomas.kazlauskas@harmony.lt',
            'gender' => 'vyras',
            'role' => '3',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'first_name' => 'Elžbieta',
            'last_name' => 'Ralienė',
            'email' => 'elzbieta.raliene@harmony.lt',
            'gender' => 'moteris',
            'password' => Hash::make('password')
        ]);

        
        $admin->assignRole('admin');  
        $superuser->assignRole('superUser');
        $user->assignRole('user');

    }
}
