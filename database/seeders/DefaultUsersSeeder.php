<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::firstOrCreate(['name' => 'admin'], [
            'name' => 'admin',
            'email' => 'admin@admin.uz',
            'password' => Hash::make('12345678'),
            'phone' => '998771234567',
            'is_admin' => true,
        ]);
    }
}
