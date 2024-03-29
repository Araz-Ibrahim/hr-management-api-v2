<?php

namespace App\Repositories\V1\Hr;

use App\Base\BaseRepository;
use App\Base\Interfaces\BaseViewInterface;
use App\Models\V1\Hr\Employee;
use App\Models\V1\Hr\Job;
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
            ->leftJoin('employee_jobs as job', 'employees.job_id', '=', 'job.id')
            ->where('employees.id', $request->id)
            ->select('employees.id', 'employees.name', 'employees.email', 'employees.manager_id', 'employees.salary', 'manager.id as manager_id', 'manager.name as manager_name',
                'job.id as job_id', 'job.title as job_title')
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
            ->leftJoin('employee_jobs as job', 'employees.job_id', '=', 'job.id')
            ->where('employees.id', $request->id)
            ->select('employees.id', 'employees.name', 'employees.email','employees.manager_id', 'employees.salary', 'manager.id as manager_id', 'manager.name as manager_name',
                'job.id as job_id', 'job.title as job_title')
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

    public function findManagers(Request $request)
    {
        // Fetch all managers up to the founder
        $employee = $this->model->where('id', $request->id)
            ->with('manager')->first();

        $currentEmployeeName = $employee->name;
        $managers = [];

        // Traverse through the nested manager relationship until reaching the founder
        while ($employee->manager && $employee->job_id !== 1) {
            $managers[] = $employee->manager->name;
            $employee = $employee->manager;
        }

        // Reverse the array to get the chain from founder to the given employee
        $managers = array_reverse($managers);

        // Add the current employee's name to the list of managers
        $managers[] = $currentEmployeeName;

        return response()->json([
            'message' => 'Managers up to the founder fetched successfully.',
            'managers' => $managers
        ]);
    }

    public function findManagersWithSalaries(Request $request)
    {
        // Fetch the current employee and its managers up to the founder
        $employee = $this->model->where('id', $request->id)
            ->with('manager')->first();

        $currentEmployeeName = $employee->name;
        $currentEmployeeSalary = $employee->salary;
        $managers = [];

        // Traverse through the nested manager relationship until reaching the founder
        while ($employee->manager) {
            $managers[$employee->manager->name] = $employee->manager->salary;
            $employee = $employee->manager;
        }

        // Reverse the array to get the chain from founder to the given employee
        $managers = array_reverse($managers, true);

        // Add the current employee's salary to the list of managers
        $managers[$currentEmployeeName] = $currentEmployeeSalary;

        return response()->json([
            'message' => 'Managers with salaries up to the founder fetched successfully.',
            'managers_with_salaries' => $managers
        ]);
    }

    public function searchEmployees(Request $request)
    {
        $searchTerm = $request->input('search');

        // If no search term provided, return all employees
        if (!$searchTerm) {
            $employees = $this->model->all();
        } else {
            // Search for employees by name or salary containing the provided search term
            $employees = $this->model
                ->where('employees.name', 'like', '%' . $searchTerm . '%')
                ->orWhere('employees.salary', 'like', '%' . $searchTerm . '%')
                ->leftJoin('employees as manager', 'employees.manager_id', '=', 'manager.id')
                ->leftJoin('employee_jobs as job', 'employees.job_id', '=', 'job.id')
                ->select('employees.id', 'employees.name', 'employees.email','employees.salary', 'manager.name as manager_name', 'job.title as job_title')
                ->get();
        }

        return response()->json([
            'message' => 'Employees fetched successfully.',
            'employees' => $employees
        ]);
    }

    public function exportEmployeesCsv()
    {
        // Fetch all employees
        $employees = $this->model->all();

        // Set headers for CSV file download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="employees.csv"',
        ];

        // Create a CSV file
        $callback = function () use ($employees) {
            $file = fopen('php://output', 'w');

            // Write headers to the CSV file
            fputcsv($file, ['ID', 'Name', 'Email', 'Manager', 'Job', 'Salary']);

            // Write employee data to the CSV file
            foreach ($employees as $employee) {
                fputcsv($file, [
                    $employee->id,
                    $employee->name,
                    $employee->email,
                    $employee->manager->name ?? 'N/A',
                    $employee->job->title,
                    $employee->salary,
                ]);
            }

            fclose($file);
        };

        // Return CSV file as a downloadable response
        return response()->stream($callback, 200, $headers);
    }

    public function importEmployeesCsv(Request $request)
    {
        // Validate the request to ensure a file is uploaded
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        // Retrieve the uploaded CSV file
        $file = $request->file('file');

        // Parse the CSV file
        $csvData = array_map('str_getcsv', file($file));

        // Remove the first row (column headers)
        array_shift($csvData);

        foreach ($csvData as $row) {
            // Assuming the columns are in the order: name, manager, salary
            $name = $row[1];
            $email = $row[2];
            $managerName = $row[3];
            $jobTitle = $row[4];
            $salary = (int) trim($row[5], '"'); // Parse salary as integer and remove double quotes

            // Lookup manager_id based on manager's name
            $manager = $this->model::where('name', $managerName)->first();
            $job = Job::where('title', $jobTitle)->first() ?? Job::create(['title' => $jobTitle]);

            // Create or update employee record
            Employee::create([
                'name' => $name,
                'email' => $email,
                'manager_id' => $manager ? $manager->id : null,
                'job_id' => $job->id,
                'salary' => $salary,
            ]);
        }

        return response()->json([
            'message' => 'Employees seeded successfully from CSV file.',
        ]);
    }

}
