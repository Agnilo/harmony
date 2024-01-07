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
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@admin.com',
            'gender' => 'moteris',
            'role' => 'administratorius',
            'password' => Hash::make('password')
        ]);

        $superuser = User::create([
            'first_name' => 'Super',
            'last_name' => 'User',
            'email' => 'sp@sp.com',
            'gender' => 'moteris',
            'role' => 'sistemos administratorius',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'first_name' => 'Generic',
            'last_name' => 'User',
            'email' => 'user@user.com',
            'gender' => 'vyras',
            'role' => 'naudotojas',
            'password' => Hash::make('password')
        ]);

        $admin->role()->attach($adminRole);
        $superuser->role()->attach($superuserRole);
        $user->role()->attach($userRole);
    }
}
