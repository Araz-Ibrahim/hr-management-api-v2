<?php

namespace App\Http\Controllers\V1\Hr;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Hr\EmployeeRequest;
use App\Mail\SalaryChangedMail;
use App\Models\V1\Hr\Employee;
use App\Services\v1\hr\employee\EmployeeService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{

    public Model $model;
    private mixed $service;

    public function __construct()
    {
        $this->model = new Employee();
        $this->service = new EmployeeService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        // Set the default values for page and perPage
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        // Fetch paginated fonts data
        $data = $this->model::paginate($perPage, ['*'], 'page', $page);

        $content = [
            'message' => 'Employees fetched successfully.',
            'list' => $data,
        ];

        return response($content, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    function store(EmployeeRequest $request)
    {
        try {
            // Check if the job_id is 1 and there is already a founder
            if ($request->job_id == 1 && $this->model->where('job_id', 1)->count() > 0) {
                return response()->json(['message' => 'Already have a founder.'], 400);
            }

            if (Employee::create($request->validated())) {
                return response()->json(['message' => 'Employee created successfully']);
            }

            return response()->json(['message' => 'Employee creation failed.'], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee creation failed.'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, $id)
    {
        try {
            // Check if the job_id is 1 and there is already a founder
            if ($request->job_id == 1 && $this->model->where('job_id', 1)->where('id', '!=', $id)->count() > 0) {
                return response()->json(['message' => 'Already have a founder.'], 400);
            }

            // Find the employee by ID
            $employee = $this->model->findOrFail($id);

            if ($employee && $employee->update($request->validated())) {

                // if salary is updated, notify the employee by email
                if ($employee->salary != $request->salary) {
                    // Send email notification to the employee
                    Mail::to($request->email)->send(new SalaryChangedMail($request->salary));
                }

                return response()->json(['message' => 'Employee updated successfully']);
            }

            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee update failed.'], 400);
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
            // Find the employee by ID
            $employee = Employee::findOrFail($employee->id);

            if ($employee->delete()) {
                return response()->json(['message' => 'Employee deleted successfully']);
            }

            return response()->json(['message' => 'Employee not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' =>'Employee deletion failed'], 400);
        }
    }

    public function createView(Request $request)
    {
        return $this->service->createView($request);
    }

    public function editView($id)
    {
        return $this->service->editView($id);
    }

    public function showView($id)
    {
        return $this->service->showView($id);
    }

    public function deleteView($id)
    {
        return $this->service->deleteView($id);
    }

    public function findManagers(Request $request)
    {
        return $this->service->findManagers($request);
    }

    public function findManagersWithSalaries(Request $request)
    {
        return $this->service->findManagersWithSalaries($request);
    }

    public function searchEmployees(Request $request)
    {
        return $this->service->searchEmployees($request);
    }

    public function exportEmployeesCsv(Request $request)
    {
        return $this->service->exportEmployeesCsv($request);
    }

    public function importEmployeesCsv(Request $request)
    {
        return $this->service->importEmployeesCsv($request);
    }
}
