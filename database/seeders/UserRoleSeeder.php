<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_role = [
            ['role_id' => 1, 'user_id' => 1, 'created_at' => Carbon::now()],
        ];
        
        DB::table('user_roles')->insert($user_role);
        
    }
}
