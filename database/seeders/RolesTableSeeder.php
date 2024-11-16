<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'buyer', 'description' => 'User who can purchase items'],
            ['name' => 'seller', 'description' => 'User who can list items for sale'],
            ['name' => 'charity', 'description' => 'Organization requesting donations'],
        ]);
    }
}
