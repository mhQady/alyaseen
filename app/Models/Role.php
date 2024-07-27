<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public const DEFAULT_ROLE_SUPERADMIN = 'Super Admin';

    public static function defaultRoles()
    {
        return [
            self::DEFAULT_ROLE_SUPERADMIN,
        ];
    }

    public function scopeSimpleSearch($query, $search)
    {
        $query->where('name', 'LIKE', "%{$search}%");
    }
    public function scopeFilter($query)
    {
        $query->when(request('search'), fn($q) => $q->simpleSearch(request('search')));
    }
}
