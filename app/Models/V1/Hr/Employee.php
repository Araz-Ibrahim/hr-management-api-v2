<?php

namespace App\Models\V1\Hr;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends BaseModel
{
    const FK = 'id';

    protected $table = 'employees';
    protected $fillable = [
        'name',
        'manager_id',
        'salary',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function managers(): HasMany
    {
        return $this->hasMany(Employee::class, 'manager_id')->with('managers');
    }

    public function isFounder(): bool
    {
        return is_null($this->manager_id);
    }
}
