<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'created_at' => Carbon::now()],
            ['name' => 'HOD', 'created_at' => Carbon::now()],
            ['name' => 'Manager', 'created_at' => Carbon::now()],
            ['name' => 'User', 'created_at' => Carbon::now()],
        ];
        
        DB::table('roles')->insert($roles);
        
    }
}
