<?php

namespace App\Repositories\V1\Hr;

use App\Base\BaseRepository;
use App\Base\Interfaces\BaseViewInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmployeeRepository extends BaseRepository implements BaseViewInterface
{
    public function __construct(Model $model)
    {
        parent::__construct($model); // call the parent constructor
    }

    public function indexView(Request $request): JsonResponse
    {
        // Implement indexView() method.
    }

    public function createView(Request $request): JsonResponse
    {
        $employees = $this->model->all()->select('id', 'name');

        return response()->json([
            'message' => 'Employee creation form opened successfully.',
            'employees' => $employees
        ]);
    }

    public function editView(Request $request): JsonResponse
    {
        $currentEmployee = $this->model->leftJoin('employees as manager', 'employees.manager_id', '=', 'manager.id')
            ->where('employees.id', $request->id)
            ->select('employees.id', 'employees.name', 'employees.manager_id', 'employees.salary', 'manager.id as manager_id', 'manager.name as manager_name')
            ->first();

        $employees = $this->model->where('id', '!=', $request->id)
            ->select('id', 'name')->get();

        return response()->json([
            'message' => 'Employee edit form opened successfully.',
            'currentEmployee' => $currentEmployee,
            'employees' => $employees
        ]);
    }

    public function filterView(Request $request): JsonResponse
    {
        // Implement filterView() method.
    }

    public function showView(Request $request): JsonResponse
    {
        $employee = $this->model->leftJoin('employees as manager', 'employees.manager_id', '=', 'manager.id')
            ->where('employees.id', $request->id)
            ->select('employees.id', 'employees.name', 'employees.manager_id', 'employees.salary', 'manager.id as manager_id', 'manager.name as manager_name')
            ->first();

        return response()->json([
            'message' => 'Employee details fetched successfully.',
            'employee' => $employee
        ]);
    }

    public function deleteView(Request $request): JsonResponse
    {
        $employee = $this->model->where('id', $request->id)->first();

        return response()->json([
            'message' => 'Employee deleted action opened successfully.',
            'employee' => $employee
        ]);
    }
}
