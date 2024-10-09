<?php

namespace App\Http\Controllers;

use App\Filters\PositionFilter;
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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
