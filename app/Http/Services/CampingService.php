<?php

namespace App\Http\Services;

use App\Models\Camping;

class CampingService
{
    const LIMIT = 8;

    public function get($page = null)
    {
        return Camping::select('id', 'name', 'description', 'thumb', 'price', 'address')
            ->where('active', 1)
            ->orderByDesc('id')
            ->when($page != null, function ($query) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return Camping::where('id', $id)
            ->where('active', 1)
            ->firstOrFail();
    }
} 