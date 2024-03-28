<?php

namespace App\Http\Controllers\V1\Hr;

use App\Base\BaseController;
use App\Http\Requests\V1\Hr\EmployeeRequest;
use App\Http\Resources\V1\Hr\EmployeeResource;
use App\Models\V1\Hr\Employee;
use App\Repositories\V1\Hr\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    public function __construct()
    {
      parent::__construct();

      $this->modelClass = new Employee();
      $this->modelResource = EmployeeResource::class;
      $this->formRequest = new EmployeeRequest();
      $this->repository = new EmployeeRepository($this->modelClass);
      $this->allowedFunctions = [];
    }

    /**
     * Store a newly created resource in storage.
     */
    function store(EmployeeRequest $request)
    {
        try {
            if ($this->repository->create($request->validationData())) {
                return response()->json(['message' => 'Employee created successfully']);
            }

            return response()->json(['message' => 'Employee creation failed.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee creation failed.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, $id)
    {
        try {
            if ($this->repository->update($id, $request->validationData())) {
                return response()->json(['message' => 'Employee updated successfully']);
            }

            return response()->json(['message' => 'Employee update failed.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee update failed.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeRequest $employee)
    {
        try {
            if ($this->repository->deleteById($employee->id)) {
                return response()->json(['message' => 'Employee deleted successfully']);
            }

            return response()->json(['message' => 'Employee deletion failed.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee deletion failed.'], 500);
        }
    }

    public function findManagers(Request $request)
    {
        return $this->repository->findManagers($request);
    }

    public function findManagersWithSalaries(Request $request)
    {
        return $this->repository->findManagersWithSalaries($request);
    }

    public function searchEmployees(Request $request)
    {
        return $this->repository->searchEmployees($request);
    }
}
