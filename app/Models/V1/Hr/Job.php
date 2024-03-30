<?php

namespace App\Models\V1\Hr;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends BaseModel
{
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
