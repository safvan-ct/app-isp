<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Developer',
                'email'      => 'dev@isp.com',
                'password'   => bcrypt('isp@2025'),
                'role'       => 'Developer',
            ],
            [
                'first_name' => 'Owner',
                'email'      => 'owner@isp.com',
                'password'   => bcrypt('isp@2025'),
                'role'       => 'Owner',
            ],
            [
                'first_name' => 'Admin',
                'email'      => 'admin@isp.com',
                'password'   => bcrypt('isp@2025'),
                'role'       => 'Admin',
            ],
            [
                'first_name' => 'Customer',
                'email'      => 'safvan@isp.com',
                'password'   => bcrypt('isp@2025'),
                'role'       => 'Customer',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'role'       => $userData['role'],
                    'first_name' => $userData['first_name'],
                    'password'   => $userData['password'],
                ]
            );

            $user->assignRole($userData['role']);
        }
    }
}
