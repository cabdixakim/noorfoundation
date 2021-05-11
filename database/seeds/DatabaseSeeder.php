<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'username' => 'Sah!ra@g8',
            'user_type' => 'admin',
            'email' => 'sugaal1332@gmail.com',
            'created_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'remember_token'=> null,
            'password' => Hash::make('e!syp@ss'),
        ]);
    }
}
