<?php

namespace App\Http\Controllers\V1\Hr;

use App\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Hr\JobRequest;
use App\Http\Resources\V1\Hr\JobResource;
use App\Models\V1\Hr\Job;
use App\Repositories\V1\Hr\JobRepository;
use Illuminate\Http\Request;

class JobController extends BaseController
{
    public function __construct()
    {
      parent::__construct();

      $this->modelClass = new Job();
      $this->modelResource = JobResource::class;
      $this->formRequest = new JobRequest();
      $this->repository = new JobRepository($this->modelClass);
      $this->allowedFunctions = [];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        try {
            if ($this->repository->create($request->validationData())) {
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
            $job = $this->repository->findById($id);
            if ($job && $this->repository->update($id, $request->validationData())) {
                return response()->json(['message' => 'Job updated successfully']);
            }

            return response()->json(['message' => 'Job update failed.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Job update failed.'], 500);
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
    public function destroy(JobRequest $job)
    {
        try {
            if ($this->repository->deleteById($job->id)) {
                return response()->json(['message' => 'Job deleted successfully']);
            }

            return response()->json(['message' => 'Job deletion failed.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Job deletion failed.'], 500);
        }
    }
}
