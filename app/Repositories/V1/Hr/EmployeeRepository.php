<?php

namespace App\Repositories\V1\Hr;

use App\Base\BaseRepository;
use App\Base\Interfaces\BaseViewInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EmployeeRepository extends BaseRepository implements BaseViewInterface
{
    public function __construct(Model $model)
    {
        parent::__construct($model); // call the parent constructor
    }

    public function indexView(Request $request): string
    {
        // Implement indexView() method.
    }

    public function createView(Request $request): string
    {
        // Implement createView() method.
    }

    public function editView(Request $request): string
    {
        // Implement editView() method.
    }

    public function filterView(Request $request): string
    {
        // Implement filterView() method.
    }

    public function showView(Request $request): string
    {
        // Implement showView() method.
    }

    public function deleteView(Request $request): string
    {
        // Implement deleteView() method.
    }
}
