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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, $id)
    {
        //
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
        //
    }
}
