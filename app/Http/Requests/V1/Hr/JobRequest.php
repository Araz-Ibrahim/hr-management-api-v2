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
            // Validate data for store
        ];
    }

    public function update()
    {
        return [
            // Validate data for update
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
