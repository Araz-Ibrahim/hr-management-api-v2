<?php

namespace App\Http\Controllers\V1\Hr;

use App\Base\BaseController;
use App\Http\Requests\V1\Hr\EmployeeRequest;
use App\Http\Resources\V1\Hr\EmployeeResource;
use App\Models\V1\Hr\Employee;
use App\Repositories\V1\Hr\EmployeeRepository;

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
    public function store(EmployeeRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, $id)
    {
        //
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
        //
    }
}
