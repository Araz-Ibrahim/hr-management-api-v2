<?php

namespace App\Http\Requests\V1\Hr;

use App\Base\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends BaseFormRequest
{
    protected function prepareForValidation()
    {
        // Prepare data before validation
    }

    public function store()
    {
        return [
            'title' => 'required|string|max:255|unique:employee_jobs,title',
        ];
    }

    public function update()
    {
        $id = $this->route('job'); // Retrieve the id from the route parameters

        return [
            'title' => 'required|string|max:255|unique:employee_jobs,title,' . $id,
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
