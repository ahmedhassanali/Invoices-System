<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
        'name' => 'Ahmed Hassan',
        'email' => 'admin@ah.com',
        'password' => bcrypt('123456'),
        'role_name' =>['owner'],
        'status' => 'valid',

        ]);
        
        $role = Role::create(['name' => 'owner']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}   
