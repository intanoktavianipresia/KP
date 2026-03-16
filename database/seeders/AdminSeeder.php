<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Pengelolaan Arsip',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminarsip1212'),
            'role' => 'admin' // pastikan ada kolom role di tabel users
        ]);
    }
}
