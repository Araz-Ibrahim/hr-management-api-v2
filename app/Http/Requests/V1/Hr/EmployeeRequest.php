<?php

namespace App\Http\Requests\V1\Hr;

use App\Base\BaseFormRequest;
use App\Models\V1\Hr\Employee;
use Illuminate\Http\Request;

class EmployeeRequest extends BaseFormRequest
{
    protected function prepareForValidation()
    {
        // Check if the job_id is 1 and should not have a manager (manager_id should be null)
        if ($this->job_id == 1) {
            $this->merge(['manager_id' => null]);
        }

        // Check if the job_id is not 1 and should have a manager (manager_id should not be null) by default set the founder as the manager
        if ($this->job_id != 1 && $this->manager_id == null) {
            $getFounderId = Employee::where('job_id', 1)->first();
            $this->merge(['manager_id' => $getFounderId->id]);
        }
    }

    public function store()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email', // 'unique' rule is added
            'manager_id' => 'nullable|integer|exists:employees,id',
            'job_id' => 'required|integer|exists:employee_jobs,id',
            'salary' => 'required|numeric',
        ];
    }

    public function update()
    {
        $id = $this->route('employee'); // Retrieve the id from the route parameters

        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $id, // 'unique' rule is added
            'manager_id' => 'nullable|integer|exists:employees,id',
            'job_id' => 'required|integer|exists:employee_jobs,id',
            'salary' => 'required|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
