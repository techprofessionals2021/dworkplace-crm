<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'project_info' => $this->getProjectInfo(),
            'project_financial_details' => $this->getFinancialDetails(),
            'project_description' => $this->description,
            'project_assignees' => $this->getProjectAssigneesWithRoles(),
            'project_transactions' => $this->getTransactions(),
            'project_attachments' => $this->getAttachments(),
            'project_threads' => $this->getThreads(),
        ];
    }

    /**
     * Get project information.
     *
     * @return array<string, mixed>
     */
    private function getProjectInfo(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'project_code' => $this->project_code,
            'sales_code' => $this->sales_code,
            'client' => optional($this->clients)->name ?? 'N/A',
            'client_id' => optional($this->clients)->id ?? null,
            'client_name' => optional($this->clients)->name ?? 'N/A',
            'source_account_id' => optional($this->sourceAccounts)->id ?? 'N/A',
            'source_account_name' => optional($this->sourceAccounts)->name ?? 'N/A',
            'platform'=> optional($this->sourceAccounts)->brand->name??'N/A',
            'sales_persons' => $this->salespersons->pluck('id'),
            'departments' => $this->getDepartment(),
            'created_at' => $this->created_at->format('Y-m-d'),
            'created_by' =>@$this->creator->name,
            'status' => optional($this->status)->name ?? 'Unknown',
            'deadline' => $this->deadline,
        ];
    }

    /**
     * Get financial details of the project.
     *
     * @return array<string, mixed>
     */
    private function getFinancialDetails(): array
    {
        return [
            'total_amount' => $this->financialDetails->total_amount,
            'upfront_amount' => $this->financialDetails->upfront_amount,
            'remaining_amount' => $this->financialDetails->remaining_amount,
            'priority' => $this->financialDetails->priority,
            'payment_type' => $this->financialDetails->payment_type,
            'currency_id'=>$this->financialDetails->currency_id,


        ];
    }

    /**
     * Get project transactions.
     *
     * @return array<int, array<string, mixed>>
     */
    private function getTransactions(): array
    {
        return $this->projectTransactions->map(fn($transaction) => [
            'id' =>$transaction->id,
            'amount' => $transaction->amount,
            'date' => $transaction->date,
            'payment_method_id'=>$transaction->payment_method_id,
            'payment_method' => optional($transaction->paymentMethod)->name ?? 'N/A',
            'currency_id'=>$transaction->currency_id,
            'currency' =>optional($transaction->currency)->symbol?? 'N/A',
            'created_by'=>optional($transaction->user)->name?? 'N/A',
        ])->toArray();
    }


    /**
     * Get project attachments.
     *
     * @return array<int, array<string, mixed>>
     */
    private function getAttachments(): array
    {
        return $this->getMedia('attachments')->map(fn($media) => [
            'file_name' => $media->file_name,
            'url' => $media->getFullUrl(),
        ])->toArray();
    }

    private function getThreads(): array
    {
        return $this->projectThreads->map(fn($thread) => [
            'user_id' => $thread->user_id,
            // 'user_name' => $thread->user->name,
            'message' => $thread->message,
            'created_at'=> $thread->created_at
        ])->toArray();
    }
    private function getProjectAssigneesWithRoles()
    {
        return $this->assignees->map(function ($assignee) {
            $user = $assignee;
            $roles = $assignee->roles->pluck('name'); // Assuming the 'name' column in roles table

            return [
                'user_id' => @$user->id,
                'user_name' => @$user->name,
                'roles' => $roles, // List of role names
            ];
        });
    }
private function getDepartment() {
    return $this->departments->map(function($proj) {
        return [
            'department_id' => $proj->id,
            'department_name' => $proj->name
        ];
    });
}




}
