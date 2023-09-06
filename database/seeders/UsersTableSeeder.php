<?php
namespace Database\Seeders;

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'fname' => 'Admin',
            'lname' => 'Admin',
            'email' => 'admin@softghor.com',
            'password' => bcrypt('admin')
        ]);
        $admin->profile()->create([
            'user_id' => $admin->id,
            'avatar' => 'dashboard/img/avatar/1.jpg'
        ]);

        $admin->assignRole('admin');


        //    TEST ADMIN - FOR TESTING
        $admin = User::create([
            'fname' => 'Test',
            'lname' => 'User',
            'email' => 'test@softghor.com',
            'password' => bcrypt('softghor1212')
        ]);
        $admin->profile()->create([
            'user_id' => $admin->id,
            'avatar' => 'dashboard/img/avatar/1.jpg'
        ]);

        $admin->assignRole('test_admin');


        $operator = User::create([
            'fname' => 'Operator',
            'lname' => 'Operator',
            'email' => 'operator@softghor.com',
            'password' => bcrypt('operator')
        ]);
        $operator->profile()->create([
            'user_id' => $operator->id,
            'avatar' => 'dashboard/img/avatar/1.jpg'
        ]);

        $operator->assignRole('operator');

        //warehouse admin
        // $warehouse_admin = User::create([
        //     'fname' => 'WarehouseAdmin',
        //     'lname' => 'warehouse_admin',
        //     'email' => 'warehouseadmin@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'warehouse'

        // ]);
        // $warehouse_admin->profile()->create([
        //     'user_id' => $warehouse_admin->id,
        //     'avatar' => 'dashboard/img/avatar/1.jpg'
        // ]);

        // $warehouse_admin->assignRole('WarehouseAdmin');
    }
}