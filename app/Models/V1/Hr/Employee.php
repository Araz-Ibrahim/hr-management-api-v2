<?php

namespace App\Models\V1\Hr;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends BaseModel
{
    const FK = 'id';

    protected $table = 'employees';
    protected $fillable = [
        'name',
        'manager_id',
        'salary',
    ];

    public function manager(): HasOne
    {
        return $this->hasOne(Employee::class, 'id', 'manager_id')->with('manager');
    }
}
