<?php

namespace App\Repositories\V1\Hr;

use App\Base\BaseRepository;
use App\Base\Interfaces\BaseViewInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobRepository extends BaseRepository implements BaseViewInterface
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
        return response()->json([
            'message' => 'Job creation form opened successfully.',
        ]);
    }

    public function editView(Request $request): JsonResponse
    {
        $job = $this->model->find($request->id);

        return response()->json([
            'message' => 'Job edit form opened successfully.',
            'job' => $job,
        ]);
    }

    public function filterView(Request $request): JsonResponse
    {
        // Implement filterView() method.
    }

    public function showView(Request $request): JsonResponse
    {
        $job = $this->model->find($request->id);

        return response()->json([
            'message' => 'Job details opened successfully.',
            'job' => $job,
        ]);
    }

    public function deleteView(Request $request): JsonResponse
    {
        $job = $this->model->find($request->id);

        return response()->json([
            'message' => 'Job deletion form opened successfully.',
            'job' => $job,
        ]);
    }
}
