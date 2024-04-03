<?php

namespace App\Models\V1\Hr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    const FK = 'id';

    protected $table = 'employees';
    protected $fillable = [
        'name',
        'email',
        'manager_id',
        'job_id',
        'salary',
    ];

    public function manager(): HasOne
    {
        return $this->hasOne(Employee::class, 'id', 'manager_id')->with('manager');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
}
