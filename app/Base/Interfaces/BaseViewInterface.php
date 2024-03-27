<?php


namespace App\Base\Interfaces;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

interface BaseViewInterface
{
    public function indexView(Request $request): string;
    public function createView(Request $request): string;
    public function editView(Request $request): string;
    public function filterView(Request $request): string;
    public function showView(Request $request): string;
    public function deleteView(Request $request): string;
}
