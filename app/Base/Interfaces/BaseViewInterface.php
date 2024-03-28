<?php


namespace App\Base\Interfaces;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface BaseViewInterface
{
    public function indexView(Request $request): JsonResponse;
    public function createView(Request $request): JsonResponse;
    public function editView(Request $request): JsonResponse;
    public function filterView(Request $request): JsonResponse;
    public function showView(Request $request): JsonResponse;
    public function deleteView(Request $request): JsonResponse;
}
