<?php

namespace MigrationsUITests\Util;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Normally this would be done with a factory, but I want to keep it
        // simple since this is a mock seeder
        $users = [];

        for ($i = 1; $i <= 5; $i++) {
            $users[] = [
                'name' => "Test User {$i}",
                'email' => "testuser{$i}@example.com",
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ];
        }

        DB::table('users')->insert($users);
    }
}
