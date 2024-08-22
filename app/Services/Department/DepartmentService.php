<?php

namespace App\Services\Department;

use App\Models\Department;

class DepartmentService
{
    /**
     * Get all departments.
     */
    public function getAllDepartments()
    {
        return Department::all();
    }

    /**
     * Create a new department.
     */
    public function createDepartment(array $data)
    {
        return Department::create($data);
    }

    /**
     * Get a department by ID.
     */
    public function getDepartmentById(string $id)
    {
        return Department::find($id);
    }

    /**
     * Update an existing department.
     */
    public function updateDepartment(string $id, array $data)
    {
        $department = $this->getDepartmentById($id);

        if (!$department) {
            return null;
        }

        $department->update($data);
        return $department;
    }

    /**
     * Delete a department.
     */
    public function deleteDepartment(string $id)
    {
        $department = $this->getDepartmentById($id);

        if (!$department) {
            return false;
        }

        return $department->delete();
    }
}
