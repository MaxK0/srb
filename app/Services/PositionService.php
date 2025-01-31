<?php

namespace App\Services;

use App\Filters\PositionFilter;
use App\Models\Employee\Position;
use App\Models\Owner\Owner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PositionService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Position::class);
    }

    public function dataForIndex(PositionFilter $filter, ?int $perPage): array
    {
        $data = [];

        if ($branchId = request()->cookie('branch_id')) {
            $data['positions'] = Owner::staticPositions()
                ->where('branch_id', $branchId)
                ->paginate($perPage)
                ->withQueryString();
        }

        return $data;
    }

    public function dataForCreate(): array
    {
        $branches = Owner::staticBranches()->select(['id', 'title'])->get();

        return compact('branches');
    }

    public function dataForEdit(Position $position): array
    {
        $branches = Owner::staticBranches()->select(['id', 'title'])->get();
        $position = $position->load([
            'branch' => fn($q) => $q->select(['id', 'title'])
        ]);

        return compact('branches', 'position');
    }
}
