<?php
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('role')->truncate();
        //Role::truncate();

        $role = [
            [
                'name' => 'admin',
                'description' => 'Kliento administratoriai'
            ],
            [
                'name' => 'superuser',
                'description' => 'Sistemos administratoriai'
            ],
            [
                'name' => 'user',
                'description' => 'Sistemos naudotojai'
            ],
            

        ];
        
        Role::insert($role);
    }
}