<?php

namespace App\Services;

use App\Filters\PositionFilter;
use App\Models\Employee\Position;
use Illuminate\Support\Collection;

class PositionService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Position::class);
    }

    public function ownerPositions(array $select = null): Collection
    {
        /** @var User $user */
        $user = auth()->user();

        $positions = $user
            ->owner
            ->positions();

        if ($select) {
            $positions = $positions
                ->map(fn($position) => $position->only($select));
        }

        return $positions;
    }

    public function dataForCreate(): array
    {
        $branchService = app(BranchService::class);

        $branches = $branchService->ownerBranches(['id', 'title']);

        return [
            'branches' => $branches
        ];
    }

    public function dataForEdit(Position $position): array
    {
        $branchService = app(BranchService::class);

        $branches = $branchService->ownerBranches(['id', 'title']);
        $position = $position->load([
            'branch' => fn($q) => $q->select(['id', 'title'])
        ]);

        return [
            'branches' => $branches,
            'position' => $position
        ];
    }
}
