<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Writer
        $user = factory(User::class)->create([
            'name' => 'Writer',
            'email' => 'writer@gmail.com',
            'type' => App\Models\UserTypes\Writer::class
        ]);

        // Supplier
        factory(User::class)->create([
            'name' => 'Supplier',
            'email' => 'supplier@gmail.com',
            'type' => App\Models\UserTypes\Supplier::class
        ]);

        // Admin
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'type' => App\Models\UserTypes\Admin::class
        ]);
    }
}
