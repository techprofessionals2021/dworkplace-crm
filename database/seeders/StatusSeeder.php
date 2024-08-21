<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'status_active', 'class' => 'primary', 'type' => 'user', 'created_at' => Carbon::now()],
            ['name' => 'status_inactive', 'class' => 'danger', 'type' => 'user', 'created_at' => Carbon::now()],
            ['name' => 'status_active', 'class' => 'primary', 'type' => 'department', 'created_at' => Carbon::now()],
            ['name' => 'status_inactive', 'class' => 'danger', 'type' => 'department', 'created_at' => Carbon::now()],
            ['name' => 'status_new', 'class' => 'primary', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_ongoing', 'class' => 'primary', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_pending', 'class' => 'secondary', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_revision', 'class' => 'warning', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_hold', 'class' => 'warning', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_forwarded', 'class' => 'secondary', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_delivered', 'class' => 'success', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_dispute', 'class' => 'danger', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_cancel', 'class' => 'danger', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_completed', 'class' => 'success', 'type' => 'project', 'created_at' => Carbon::now()],
            ['name' => 'status_new', 'class' => 'primary', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_ongoing', 'class' => 'primary', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_pending', 'class' => 'secondary', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_revision', 'class' => 'warning', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_hold', 'class' => 'warning', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_forwarded', 'class' => 'secondary', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_delivered', 'class' => 'success', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_dispute', 'class' => 'danger', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_cancel', 'class' => 'danger', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_completed', 'class' => 'success', 'type' => 'direct_project', 'created_at' => Carbon::now()],
            ['name' => 'status_new', 'class' => 'primary', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_ongoing', 'class' => 'primary', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_pending', 'class' => 'secondary', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_revision', 'class' => 'warning', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_hold', 'class' => 'warning', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_forwarded', 'class' => 'secondary', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_delivered', 'class' => 'success', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_dispute', 'class' => 'danger', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_cancel', 'class' => 'danger', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_completed', 'class' => 'success', 'type' => 'project_update', 'created_at' => Carbon::now()],
            ['name' => 'status_assigned', 'class' => 'primary', 'type' => 'user_target', 'created_at' => Carbon::now()],
            ['name' => 'status_achieved', 'class' => 'success', 'type' => 'user_target', 'created_at' => Carbon::now()],
            ['name' => 'status_assigned', 'class' => 'primary', 'type' => 'brand_target', 'created_at' => Carbon::now()],
            ['name' => 'status_achieved', 'class' => 'success', 'type' => 'brand_target', 'created_at' => Carbon::now()],
            ['name' => 'status_assigned', 'class' => 'primary', 'type' => 'word_count', 'created_at' => Carbon::now()],
            ['name' => 'status_submitted', 'class' => 'primary', 'type' => 'word_count', 'created_at' => Carbon::now()],
            ['name' => 'status_approved', 'class' => 'success', 'type' => 'word_count_submit', 'created_at' => Carbon::now()],
            ['name' => 'status_rejected', 'class' => 'danger', 'type' => 'word_count_submit', 'created_at' => Carbon::now()],
        ];
        
        DB::table('statuses')->insert($statuses);
    }
}
