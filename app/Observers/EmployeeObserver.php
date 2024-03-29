<?php

namespace App\Observers;

use App\Models\V1\Hr\Employee;
use App\Models\V1\Hr\EmployeeLog;

class EmployeeObserver
{
    public function created(Employee $employee)
    {
        $this->logEmployeeAction($employee, 'created');
    }

    public function updated(Employee $employee)
    {
        $this->logEmployeeAction($employee, 'updated', true);
    }

    public function deleted(Employee $employee)
    {
        $this->logEmployeeAction($employee, 'deleted');
    }

    protected function logEmployeeAction(Employee $employee, string $action, $saveChanges = false)
    {
        $changes = [];

        if ($saveChanges) {

            foreach ($employee->getDirty() as $attribute => $value) {

                // Skip 'updated_at' column
                if ($attribute === 'updated_at') {
                    continue;
                }

                $original = $employee->getOriginal($attribute);
                $changes[$attribute] = [
                    'old' => $original,
                    'new' => $value,
                ];
            }
        }

        EmployeeLog::create([
            'action' => $action,
            'employee_id' => $employee->id,
            'user_id' => auth()->id(), // Assuming you have authentication and want to log the current user's ID
            'changes' => json_encode($changes) ?? [], // Convert changes array to JSON
        ]);
    }
}
