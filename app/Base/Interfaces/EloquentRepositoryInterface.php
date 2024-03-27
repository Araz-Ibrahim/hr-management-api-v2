<?php

namespace App\Base\Interfaces;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

interface EloquentRepositoryInterface
{
    public function all(array $columns = ['*'], array $relations = []): Collection;
    public function allTrashed(): Collection;
    public function findById(
        int   $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;
    public function findTrashedById(int $modelId): ?Model;
    public function findOnlyTrashedById(int $modelId): ?Model;
    public function deleteById(int $modelId): bool;
    public function restoreById(int $modelId): bool;
    public function permanentlyDeleteById(int $modelId): bool;
}
