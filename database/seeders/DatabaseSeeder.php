<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'testuser',
            'name' => 'Test User',
            'email' => 'user@co.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('123'),
            'phone' => '1234567890',
            'picture' => 'default.png',
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'balance' => 1000,
        ]);

        DB::table('mitras')->insert([
            'username' => 'mitrauser',
            'name' => 'Mitra User',
            'email' => 'mitrauser@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'),
            'phone' => '0987654321',
            'picture' => 'default.png',
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'profit' => 2000.00,
        ]);
    }
}
