<?php

namespace App\Http\Requests\V1\Hr;

use App\Base\BaseFormRequest;

class EmployeeRequest extends BaseFormRequest
{
    protected function prepareForValidation()
    {
        // Prepare data before validation
    }

    public function store()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email', // 'unique' rule is added
            'manager_id' => 'required|integer|exists:employees,id',
            'job_id' => 'required|integer|exists:employee_jobs,id',
            'salary' => 'required|numeric',
        ];
    }

    public function update()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $this->id, // 'unique' rule is added
            'manager_id' => 'required|integer|exists:employees,id',
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
