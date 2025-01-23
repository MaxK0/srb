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
        $data['branches'] = Owner::staticBranches()->select(['id', 'title'])->get();

        if ($data['filter']['branchId'] = request('branch_id')) {
            $data['positions'] = Owner::staticPositions()
                ->filter($filter)
                ->select('id', 'title')
                ->paginate($perPage)
                ->withQueryString();
        }

        return $data;
    }

    public function dataForCreate(): array
    {
        $branches = Owner::staticBranches()->select(['id', 'title'])->get();

        return [
            'branches' => $branches
        ];
    }

    public function dataForEdit(Position $position): array
    {
        $branches = Owner::staticBranches()->select(['id', 'title'])->get();
        $position = $position->load([
            'branch' => fn($q) => $q->select(['id', 'title'])
        ]);

        return [
            'branches' => $branches,
            'position' => $position
        ];
    }
}
