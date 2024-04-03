<?php

namespace App\Models\V1\Hr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    const FK = 'id';

    protected $table = 'employee_jobs';

    protected $fillable = [
        'title',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'job_id', 'id');
    }
}
