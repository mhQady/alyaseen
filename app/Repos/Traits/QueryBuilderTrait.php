<?php

namespace App\Repos\Traits;

trait QueryBuilderTrait
{

    protected function setClauses(): static
    {


        foreach ($this->wheres as $where) {
            $this->query->where($where['column'], $where['operator'], $where['value']);
        }

        foreach ($this->orderBys as $orders) {
            $this->query->orderBy($orders['column'], $orders['direction']);
        }

        return $this;
    }
    public function orderBy(string $column, string $direction = 'asc'): static
    {
        $this->orderBys[] = compact('column', 'direction');

        return $this;
    }
}
