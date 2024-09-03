<?php

namespace App\Services\SourceAccount;

use App\Models\SourceAccount\SourceAccount;

class SourceAccountService
{
    /**
     * Get all sourceAccount.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllSourceAccount()
    {
        return SourceAccount::all();
    }

    public function getSourceAccountById(string $id)
    {
        return SourceAccount::find($id);
    }

    public function createSourceAccount(array $data)
    {
        return SourceAccount::create($data);
    }

    public function updateSourceAccount(array $data, int $id)
    {
        $sourceAccount = SourceAccount::findOrFail($id);
        if (!$sourceAccount) {
            return null;
        }
        $sourceAccount->update($data);
        return $sourceAccount;
    }
    public function deleteSourceAccount(string $id)
    {
        $sourceAccount = $this->getSourceAccountById($id);

        if (!$sourceAccount) {
            return false;
        }

        return $sourceAccount->delete();
    }

    
}