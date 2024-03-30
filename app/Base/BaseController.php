<?php

namespace App\Base;

use App\Base\Interfaces\BaseViewInterface;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
//use Illuminate\Support\Facades\Validator;

/**
 * The BaseController class serves as the parent class for all controllers in the application, and implements the BaseViewInterface.
 */
class BaseController extends Controller implements BaseViewInterface
{
    public mixed $repository; // Holds a reference to the repository class that implements the BaseViewInterface
    protected mixed $formRequest; // Holds a reference to the form request class for the controller
    public Model $modelClass; // Holds the class name of the model
    protected string $modelResource; // Holds the name of the resource for the model
    protected array $allowedFunctions = []; // Holds a list of allowed functions for the controller
    private array $defaultAllowedFunctions = ['indexView', 'editView', 'createView', 'showView', 'deleteView'];

    /**
     * The constructor initializes the $allowedFunctions array to include the
     * default view functions.
     */
    public function __construct()
    {
        // Construct the repository
    }


    /**
     * Handles the store method request.
     * @param Request $request The HTTP request object.
     * @return Application|Response|ResponseFactory The HTTP response.
     */
    public function list(Request $request): Response|Application|ResponseFactory
    {
        $validator = $this->validateRequest($request, $this->indexValidationsArray());
        if ($validator->fails()) {
            return response()->json([$validator->errors()->all()], 422);
        }

        // Set the default values for page and perPage
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        // Fetch paginated fonts data
        $data = $this->modelClass::paginate($perPage, ['*'], 'page', $page);

        $content = [
            'data' => $this->modelResource::collection($data),
        ];

        return response($content, Response::HTTP_OK);
    }

    /**
     * Validates an HTTP request object against an array of validation rules.
     *
     * @param Request $request The HTTP request object.
     * @param array $validationsArray The array of validation rules.
     * @return mixed The validator object.
     */
    private function validateRequest($request, $validationsArray)
    {
        return \Validator::make($request->all(), $validationsArray);
    }

    /**
     * Returns an array of validation rules for the index method.
     * @return array The validation rules for the index method.
     */
    private function indexValidationsArray(): array
    {
        return [
            'length' => ['integer', 'min:1', 'max:500'],
            'start' => ['integer', 'min:0', 'max:1000'],
        ];
    }

    /**
     * Handles the index method request.
     * @param Request $request The HTTP request object.
     * @return Application|Response|ResponseFactory The HTTP response.
     */
    public function index(Request $request): Application|Response|ResponseFactory
    {
        $this->validateRequest($request, $this->indexValidationsArray());
        $validator = $this->validateRequest($request, $this->indexValidationsArray());
        if ($validator->fails()) {
            return response()->json([$validator->errors()->all()], 422);
        }
        $data = $this->modelClass->get();
        return \response()->json([$this->modelResource::collection($data)]);
    }

    /**
     * Handles the callMethod method request.
     * @param Request $request The HTTP request object.
     * @param string $method The method to call.
     * @return mixed The HTTP response or a JSON response with errors.
     */
    public function callMethod(Request $request, $method)
    {
        // Convert all allowed functions to lowercase
        $allowedFunctionsLower = array_map('strtolower', array_unique(array_merge(
            $this->allowedFunctions,
            $this->defaultAllowedFunctions
        )));

        // Check if the method is allowed (case-insensitive)
        if (in_array(strtolower($method), $allowedFunctionsLower)) {
            // Call the method
            return $this->$method($request);
        }

        // Method not allowed, return JSON response with error
        return response()->json(['error' => 'Method not allowed'], 405);
    }

    public function indexView(Request $request): JsonResponse
    {
        return $this->repository->indexView($request);
    }

    public function createView(Request $request): JsonResponse
    {
        return $this->repository->createView($request);
    }

    public function editView(Request $request): JsonResponse
    {
        return $this->repository->editView($request);
    }

    public function filterView(Request $request): JsonResponse
    {
        return $this->repository->filterView($request);
    }

    public function showView(Request $request): JsonResponse
    {
        return $this->repository->showView($request);
    }

    public function deleteView(Request $request): JsonResponse
    {
        return $this->repository->deleteView($request);
    }

    public function getModelClass(): string
    {
        return $this->modelClass;
    }
}
