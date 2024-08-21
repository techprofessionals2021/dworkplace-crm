<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = [
            ['manager_id' => 1,'name' => 'Main Department','description' => 'Main Department','status_id' => 3,'type' => 'department',  'created_at' => Carbon::now()]
        ];
    
        DB::table('departments')->insert($department);
    }
}
