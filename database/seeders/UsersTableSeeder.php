<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => '9823901118',
                'password' => Hash::make('atish123'),
                'admin_id' => null,
                'client_id' => null,
                'staff_id' => null,
                'created_by' => null,
                'created_on' => now(),
                'updated_by' => null,
                'updated_on' => now(),
                'deleted_by' => null,
                'deleted_on' => null,
                'deleted_status' => false,
                'last_updated' => now(),
            ],
            [
                'username' => '9764551641',
                'password' => Hash::make('mahesh123'),
                'admin_id' => null,
                'client_id' => null,
                'staff_id' => null,
                'created_by' => null,
                'created_on' => now(),
                'updated_by' => null,
                'updated_on' => now(),
                'deleted_by' => null,
                'deleted_on' => null,
                'deleted_status' => false,
                'last_updated' => now(),
            ]
        ]);
    }
}
