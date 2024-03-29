<?php

namespace App\Models\V1\Hr;

use App\Base\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class EmployeeLog extends Model
{
    protected $table = 'employee_logs';

    protected $fillable = [
        'action',
        'employee_id',
        'user_id',
        'changes',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
