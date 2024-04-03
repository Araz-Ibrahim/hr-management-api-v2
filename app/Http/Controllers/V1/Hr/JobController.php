<?php

namespace App\Http\Controllers\V1\Hr;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Hr\JobRequest;
use App\Models\V1\Hr\Job;
use App\Services\V1\Hr\JobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        // Set the default values for page and perPage
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        // Fetch paginated fonts data
        $data = Job::paginate($perPage, ['*'], 'page', $page);

        $content = [
            'message' => 'Jobs fetched successfully.',
            'list' => $data,
        ];

        return response($content, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        try {
            if (Job::create($request->validated())) {
                return response()->json(['message' => 'Job created successfully']);
            }

            return response()->json(['message' => 'Job creation failed.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Job creation failed.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, $id)
    {
        try {

            $job = Job::findOrFail($id);

            if ($job && $job->update($request->validated())) {
                return response()->json(['message' => 'Job updated successfully']);
            }

            return response()->json(['message' => 'Job not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Job update failed.'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            // validate the $id
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:employee_jobs,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Invalid job ID.'], 400);
            }

            // Find the job by ID
            $job = Job::findOrFail($id);

            // Check if the job is assigned to any employee
            if ($job->employees()->count() > 0) {
                return response()->json(['message' => 'Job is assigned to an employee.'], 400);
            }

            // can't delete the founder job
            if ($job->id == 1) {
                return response()->json(['message' => 'Can\'t delete the founder job.'], 400);
            }

            // delete the job
            if ($job->delete()) {
                return response()->json(['message' => 'Job deleted successfully']);
            }

            return response()->json(['message' => 'Job not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function createView(Request $request, JobService $service)
    {
        return $service->createView($request);
    }

    public function editView($id, JobService $service)
    {
        return $service->editView($id);
    }

    public function showView($id, JobService $service)
    {
        return $service->showView($id);
    }

    public function deleteView($id, JobService $service)
    {
        return $service->deleteView($id);
    }
}
