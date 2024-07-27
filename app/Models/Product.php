<?php

namespace App\Models;

use App\Enums\Product\StatusEnum;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasTranslations, LogsActivity;

    protected $fillable = ['name', 'description', 'slug', 'status', 'price', 'sku', 'current_stock', 'min_purchase_qty', 'max_purchase_qty'];
    public $translatable = ['name', 'description'];

    protected function casts(): array
    {
        return [
            'status' => StatusEnum::class,
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['price', 'current_stock', 'category_id']);
    }

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeGetByStatus($query, $status)
    {
        $query->where('status', $status);
    }

    public function scopeSimpleSearch($query, $search)
    {
        $query->where('name->en', 'LIKE', "%{$search}%")
            ->orWhere('name->ar', 'LIKE', "%{$search}%")
            ->orWhere('slug', 'LIKE', "%{$search}%")
            ->orWhere('sku', 'LIKE', "%{$search}%");
    }
    public function scopeFilter($query)
    {
        $query->when(request('search'), fn($q) => $q->simpleSearch(request('search')));
        $query->when(request('status'), fn($q) => $q->getByStatus(request('status')));
    }

}
