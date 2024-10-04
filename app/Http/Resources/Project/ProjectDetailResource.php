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
            'project_assignees' => $this->projectAssignees->pluck('user_id'),
            'project_transactions' => $this->getTransactions(),
            'project_attachments' => $this->getAttachments(),
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
            'source_account' => optional($this->sourceAccounts)->name ?? 'N/A',
            'created_at' => $this->created_at,
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
            'amount' => $transaction->amount,
            'date' => $transaction->date,
            'payment_method' => optional($transaction->paymentMethod)->name ?? 'N/A',
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
            'url' => $media->getUrl(),
        ])->toArray();
    }
}