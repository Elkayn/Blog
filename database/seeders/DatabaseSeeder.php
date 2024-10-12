<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            'email' => 'user@mail.ru',
            'password' => Hash::make(123123)
        ];

        $user = User::firstOrCreate([
            'email' => $user['email']
        ], [
            'password' => Hash::make(123123)
        ]);
        $user2 = User::Create([
            'email' => 'tr@mail.ru',
            'password' => Hash::make(12345)
        ]);

        $role = Role::firstOrCreate([
            'title' => 'admin'
        ]);

        $user->roles()->sync($role->id);

        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            RoleSeeder::class
        ]);
        $user2->roles()->sync(2);
    }
}
