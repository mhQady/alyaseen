<?php

namespace App\Http\Controllers\Dash\Traits;

trait BaseCrudTrait
{
    protected function initiateForIndex()
    {
        $this->page = request()->has('page') ? (int) request('page') : 1;
        $this->perPage = request()->has('per_page') ? (int) request('per_page') : 25;
        $this->orderBy = request('order_by', 'created_at');
        $this->orderDir = request('order_dir', 'desc');
    }

    private function initiateViewPath()
    {
        $this->viewPath = "dash.{$this->modelName}";
    }
}
