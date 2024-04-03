<?php

namespace App\Services\V1\Hr;

use App\Models\V1\Hr\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobService
{
    public function createView(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'Job creation form opened successfully.',
        ]);
    }

    public function editView($id): JsonResponse
    {
        // validate the $id
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:employee_jobs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid job ID.'], 400);
        }

        $job = Job::find($id);

        return response()->json([
            'message' => 'Job edit form opened successfully.',
            'job' => $job,
        ]);
    }

    public function showView($id): JsonResponse
    {
        // validate the $id
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:employee_jobs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid job ID.'], 400);
        }

        $job = Job::find($id);

        return response()->json([
            'message' => 'Job details opened successfully.',
            'job' => $job,
        ]);
    }

    public function deleteView($id): JsonResponse
    {
        // validate the $id
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:employee_jobs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid job ID.'], 400);
        }

        $job = Job::find($id);

        return response()->json([
            'message' => 'Job deletion form opened successfully.',
            'job' => $job,
        ]);
    }}
