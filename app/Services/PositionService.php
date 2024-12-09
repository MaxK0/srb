<?php

namespace App\Services;

use App\Filters\PositionFilter;
use App\Models\Employee\Position;
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
        $branchService = app(BranchService::class);
        $data['branches'] = $branchService->ownerBranches(['id', 'title'])->get();

        if ($data['filter']['branchId'] = request('branch_id')) {
            $data['positions'] = $this->ownerPositions()
                ->filter($filter)
                ->select('id', 'title')
                ->paginate($perPage)
                ->withQueryString();
        }

        return $data;
    }

    // TODO: Перенести в OwnerService
    public function ownerPositions(array $select = null): Builder
    {
        /** @var User $user */
        $user = auth()->user();

        $positions = $user
            ->owner
            ->positions();

        if ($select) {
            $positions->select($select);
        }

        return $positions;
    }

    public function dataForCreate(): array
    {
        $branchService = app(BranchService::class);

        $branches = $branchService->ownerBranches(['id', 'title'])->get();

        return [
            'branches' => $branches
        ];
    }

    public function dataForEdit(Position $position): array
    {
        $branchService = app(BranchService::class);

        $branches = $branchService->ownerBranches(['id', 'title'])->get();
        $position = $position->load([
            'branch' => fn($q) => $q->select(['id', 'title'])
        ]);

        return [
            'branches' => $branches,
            'position' => $position
        ];
    }
}
