<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            $user = User::create([
                'name' => 'Abdelkarim', 
                'email' => 'abdelkarimmohamedali81@gmail.com',
                'password' => bcrypt('abdelkarimmohamedali81@gmail.com'),
                'roles_name' => ["owner"],
                'Status' => 'مفعل',
                ]);
          
                $role = Role::create(['name' => 'owner']);
           
                $permissions = Permission::pluck('id','id')->all();
          
                $role->syncPermissions($permissions);
           
                $user->assignRole([$role->id]);
    }
}
