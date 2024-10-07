<?php

namespace App\Services;

use App\Filters\PositionFilter;
use App\Models\Employee\Position;

class PositionService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Position::class);
    }

    public function branchPositions(?PositionFilter $filter): array
    {
        // if (!$filter) {
        //     $branch = auth()
        //         ->user()
        //         ->owner()
        //         ->first()
        //         ->businesses()
        //         ->first()
        //         ->branches()
        //         ->first();
        // }

        dd(Position::filter($filter)->get());

        return [];
    }
}
