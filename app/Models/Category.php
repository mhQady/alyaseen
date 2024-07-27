<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $guarded = ['id'];
    public $translatable = ['name', 'description'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeSimpleSearch($query, $search)
    {
        $query->where('name->en', 'LIKE', "%{$search}%")
            ->orWhere('name->ar', 'LIKE', "%{$search}%");
    }
    public function scopeFilter($query)
    {
        $query->when(request('search'), fn($q) => $q->simpleSearch(request('search')));
    }
}
