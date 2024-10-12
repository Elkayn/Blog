<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public array $titles = ['kadrEditor', 'commentsEditor'];

    public function run(): void
    {
        foreach ($this->titles as $title){
            Role::create(['title'=> $title]);
        }
    }
}
