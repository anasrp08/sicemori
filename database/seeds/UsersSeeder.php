<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin role
        $adminRole = new Role();
        $adminRole->name = "admin"; 
        $adminRole->display_name = "Admin";
        $adminRole->save();

        // Create Member role
        $beacukaiRole = new Role();
        $beacukaiRole->name = "candal";
        $beacukaiRole->display_name = "Candal";
        $beacukaiRole->save();

        $taskforceRole = new Role();
        $taskforceRole->name = "cemor"; 
        $taskforceRole->display_name = "cemor";
        $taskforceRole->save();

        // Create Admin sample
        $admin = new User();
        $admin->name = 'Admin SiCemori';
        $admin->email = 'admin@sicemori';
        $admin->instansi = 'Admin';
        $admin->password = bcrypt('admin123');
        $admin->avatar = "admin_avatar.png";
        $admin->is_verified = 1;
        $admin->save();
        $admin->attachRole($adminRole);

        // Create Sample member
        $bc = new User();
        $bc->name = 'Candal';
        $bc->email = 'candal@sicemori';
        $bc->instansi = 'Candal';
        $bc->password = bcrypt('candal123');
        $bc->avatar = "bc_avatar.png";
        $bc->is_verified = 1;
        $bc->save();
        $bc->attachRole($beacukaiRole);

        $tf = new User();
        $tf->name = 'Cemor';
        $tf->email = 'cemor@sicemori';
        $tf->instansi = 'Cemor';
        $tf->password = bcrypt('cemor123');
        $tf->avatar = "tf_avatar.png";
        $tf->is_verified = 1;
        $tf->save();
        $tf->attachRole($taskforceRole);
    }
}
