<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo một tài khoản admin cố định
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password')
        ]);

        // Tạo 10 tài khoản user thông thường
        User::factory(10)->create();

        // Tạo 50 sản phẩm mẫu
        Product::factory(50)->create();
    }
}
