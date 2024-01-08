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
        DB::table('role_user')->truncate();
        Schema::enableForeignKeyConstraints();

        $adminRole = Role::where('name', 'admin')->first();
        $superuserRole = Role::where('name', 'superuser')->first();
        $userRole = Role::where('name', 'user')->first();

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

        $admin->role()->attach($adminRole);
        $superuser->role()->attach($superuserRole);
        $user->role()->attach($userRole);
    }
}
