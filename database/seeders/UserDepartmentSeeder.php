<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_department = [
            ['user_id' => 1, 'department_id' => 1, 'created_at' => Carbon::now()],
        ];
        
        DB::table('user_departments')->insert($user_department);
    }
}
