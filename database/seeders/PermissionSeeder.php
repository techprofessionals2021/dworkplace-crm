<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'view_users', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'create_user', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'edit_user', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'delete_user', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_all_departments', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_own_department', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'create_department', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'assign_department', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'edit_department', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'delete_department', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_user_target', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'create_user_target', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'edit_user_target', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_own_target', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_department_target', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'create_role', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_role', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'assign_role', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'delete_role', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'edit_status', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_brand', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'create_brand', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'edit_brand', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'delete_brand', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_currency', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'create_currency', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_currency', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'delete_currency', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'create_payment_method', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_payment_method', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_payment_method', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'delete_payment_method', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_source_account', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'create_source_account', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'edit_source_account', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'delete_source_account', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_client', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'create_client', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_client', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'delete_client', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_direct_client', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'create_direct_client', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_direct_client', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'delete_direct_client', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_work_type', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'create_work_type', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'edit_work_type', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'delete_work_type', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_brand_target', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'create_brand_target', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'edit_brand_target', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'delete_brand_target', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_all_projects', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'view_department_projects', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_assigned_projects', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'create_project', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_project', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_project_status', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'delete_project', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'view_all_project_statuses', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'view_limited_project_statuses', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_all_direct_projects', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'view_assigned_direct_projects', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'create_direct_project', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_direct_project', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_direct_project_status', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'delete_direct_project', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'assign_project', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'assign_project_word_count', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'view_project_update', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'create_project_update', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_project_update', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_project_update_status', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_project_thread', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'create_project_thread', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'reply_project_thread', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_all_submitted_word_count', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'submit_word_count', 'type' => 'department', 'created_at' => Carbon::now()],
            ['name' => 'view_own_submitted_word_count', 'type' => 'department', 'created_at' => Carbon::now()],
            ['name' => 'view_project_transactions', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'create_project_transaction', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'edit_project_transaction', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'delete_project_transaction', 'type' => 'both', 'created_at' => Carbon::now()],
            ['name' => 'view_all_reports', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_department_reports', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_team_reports', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_user_dashboard', 'type' => 'general', 'created_at' => Carbon::now()],
            ['name' => 'view_sales_dashboard', 'type' => 'department', 'created_at' => Carbon::now()],
        ];
        

        DB::table('permissions')->insert($permissions);

    }
}
