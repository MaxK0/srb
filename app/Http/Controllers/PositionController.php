<?php

namespace App\Http\Controllers;

use App\Filters\PositionFilter;
use App\Http\Requests\Position\StoreRequest;
use App\Http\Requests\Position\UpdateRequest;
use App\Models\Employee\Position;
use App\Services\BranchService;
use App\Services\PositionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PositionController extends Controller
{
    public function __construct(
        protected PositionService $positionService,
        protected BranchService $branchService
    ) {}


    public function index(Request $request, PositionFilter $filter)
    {
        $data = [
            'branches' => $this->branchService
                ->ownerBranches()
                ->map(fn($branch) => $branch->only(['id', 'title'])),
        ];

        if ($branchId = $request->input('branch_id')) {
            $data['positions'] = Position::filter($filter)->paginate(25)->withQueryString();
            $data['branchId'] = $branchId;
        }

        return Inertia::render('Position/Index', $data);
    }

    public function create()
    {
        $data = $this->positionService->dataForCreate();

        return Inertia::render('Position/Create', $data);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->positionService->create($data);

        return redirect()->route('positions.index');
    }

    public function show(Position $position)
    {
        return Inertia::render('Position/Show', [
            'position' => $position->load([
                'branch' => fn($q) => $q->select('id', 'title')
            ])
        ]);
    }

    public function edit(Position $position)
    {
        $data = $this->positionService->dataForEdit($position);

        return Inertia::render('Position/Edit', $data);
    }

    public function update(UpdateRequest $request, Position $position)
    {
        $data = $request->validated();

        $this->positionService->update($position, $data);

        return redirect()->route('positions.index');
    }

    public function destroy(Position $position)
    {
        $this->positionService->delete($position);

        return redirect()->route('positions.index', request()->query());
    }
}
