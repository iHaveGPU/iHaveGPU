<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $roleColumn = Schema::hasColumn('users', 'role') ? 'role' : (Schema::hasColumn('users', 'user_role') ? 'user_role' : 'role');

        $users = [
            ['name'=>'SCKagura','email'=>'sckagura9164@gmail.com','pass'=>'12345678','role'=>'admin'],
            ['name'=>'staff','email'=>'staff@example.com','pass'=>'12345678','role'=>'staff'],
            ['name'=>'Customer','email'=>'customer@example.com','pass'=>'12345678','role'=>'customer'],
        ];

        foreach ($users as $u) {
            $payload = [
                'name'  => $u['name'],
                'email' => $u['email'],
                $roleColumn => $u['role'],
                'password' => Hash::make($u['pass']),
            ];
            if (Schema::hasColumn('users','status')) $payload['status'] = 'active';
            if (Schema::hasColumn('users','email_verified_at')) $payload['email_verified_at'] = null;

            User::updateOrCreate(['email'=>$u['email']], $payload);
        }
    }
}
