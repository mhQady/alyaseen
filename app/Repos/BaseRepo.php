<?php

namespace App\Repos;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Repos\Traits\QueryBuilderTrait;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepo implements BaseRepoInterface
{
    use QueryBuilderTrait;

    protected Builder $query;
    protected ?int $take;

    protected array $with = [];

    protected array $wheres = [];

    protected array $whereIns = [];

    protected array $orderBys = [];

    protected string $groupBy;

    protected array $scopes = [];

    protected string $mediaCollection = 'default';

    protected LengthAwarePaginator|Collection|Model|null $response = null;

    public function __construct(protected Model $model)
    {
        $this->model = $model;
        $this->query = $this->model->query();
    }

    public function getModel(): Model
    {
        return $this->model;
    }
    public function list(int $page = 1, int $perPage = 25): static
    {
        $this->setClauses()->eagerLoad();

        $this->response = match ((bool) $page) {
            true => $this->query->filter()->paginate(perPage: $perPage, page: $page),
            false => $this->query->filter()->get()
        };

        $this->unsetClauses();

        return $this;
    }

    public function getByKey(int|string $val, string $key = 'id'): static
    {
        $this->setClauses()->eagerLoad();

        $this->response = $this->query->where($key, '=', $val)->first();

        return $this;
    }

    public function create(array $data)
    {
        try {
            $this->unsetClauses();

            DB::beginTransaction();

            $this->response = $this->model->create($data);

            DB::commit();

            return $this;
        } catch (\Exception $e) {
            DB::rollBack();

            if (DB::transactionLevel() == 1)
                throw $e;
        }
    }

    public function update($id, array $data)
    {
        $this->setClauses();

        $this->getByKey($id);

        try {
            DB::beginTransaction();

            $this->response?->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            if (DB::transactionLevel() == 1)
                throw $e;
        }

        return $this;
    }

    public function delete(int|string $val, string $key = 'id'): static
    {
        $this->setClauses();

        $this->query->where($key, '=', $val)->delete();

        $this->unsetClauses();

        return $this;
    }

    public function getResult()
    {
        return $this->response;
    }


    public function where($column, $value, $operator = '=')
    {
        $this->wheres[] = compact('column', 'value', 'operator');

        return $this;
    }

    public function groupBy(string $column)
    {
        $this->groupBy = $column;

        return $this;
    }

    public function orWhere($column, $value, $operator = '='): static
    {
        $this->wheres[] = compact('column', 'value', 'operator');

        return $this;
    }


    public function whereIn($column, $values): static
    {
        $values = is_array($values) ? $values : array($values);

        $this->whereIns[] = compact('column', 'values');

        return $this;
    }


    public function with($relations): static
    {
        if (is_string($relations)) {
            $relations = func_get_args();
        }

        $this->with = $relations;

        return $this;
    }


    protected function eagerLoad(): static
    {
        foreach ($this->with as $relation) {
            $this->query->with($relation);
        }

        return $this;
    }


    protected function setScopes(): static
    {
        foreach ($this->scopes as $method => $args) {
            $this->query->$method(implode(', ', $args));
        }

        return $this;
    }


    protected function unsetClauses(): static
    {
        $this->wheres = [];
        $this->whereIns = [];
        $this->scopes = [];
        $this->take = null;

        return $this;
    }


    public function sendResponse($data = null, $message = null, $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        if (!is_null($this->response) && $this->response::class == LengthAwarePaginator::class) {
            $response['meta'] = [
                'total' => $data->total(),
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'last_page' => $data->lastPage(),
                'path' => $data->path(),
            ];
        }

        return response()->json($response, $code);
    }


    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        $this->response = response()->json($response, $code);

        return $this;
    }
}
