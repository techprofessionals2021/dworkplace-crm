<?php

namespace App\Services\ProjectTransaction;

use App\Models\Project\ProjectTransaction;
class ProjectTransactionService
{
  public function getAllProjectTansactions()
  {
    return ProjectTransaction::all();

  }
  public function createTransaction(array $data)
  {
      return ProjectTransaction::create($data);
  }


  public function getProjectTransactionById(string $id)
    {
        return ProjectTransaction::find($id);
    }

    /**
     * Update an existing project transaction.
     */
    public function updateProjectTransaction(string $id, array $data)
    {
        $projectTransaction = $this->getProjectTransactionById($id);

        if (!$projectTransaction) {
            return null;
        }

        $projectTransaction->update($data);
        return $projectTransaction;
    }
    public function deleteProjectTransaction(string $id)
    {
        $projectTransaction = $this->getProjectTransactionById($id);

        if (!$projectTransaction) {
            return false;
        }

        return $projectTransaction->delete();
    }
}
