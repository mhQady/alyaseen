<?php

namespace App\Models;

class Activity extends \Spatie\Activitylog\Models\Activity
{
    public function scopeSimpleSearch($query, $search)
    {
        $query->where('properties->attributes->price', 'LIKE', "%{$search}%")
            ->orWhere('properties->new->price', 'LIKE', "%{$search}%")
            ->orWhere('properties->attributes->category_id', 'LIKE', "%{$search}%")
            ->orWhere('properties->new->category_id', 'LIKE', "%{$search}%")
            ->orWhere('properties->attributes->current_stock', 'LIKE', "%{$search}%")
            ->orWhere('properties->new->current_stock', 'LIKE', "%{$search}%");
    }
    public function scopeFilter($query)
    {
        $query->when(request('search'), fn($q) => $q->simpleSearch(request('search')));
    }
}
