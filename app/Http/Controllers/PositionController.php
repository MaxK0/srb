<?php

namespace App\Http\Controllers;

use App\Filters\PositionFilter;
use App\Http\Requests\Position\StoreRequest;
use App\Http\Requests\Position\UpdateRequest;
use App\Models\Employee\Position;
use App\Services\PositionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PositionController extends Controller
{
    public function __construct(
        protected PositionService $positionService
    ) {}


    public function index(Request $request, PositionFilter $filter)
    {
        $data = $this->positionService->dataForIndex($filter, $request->get('perPage', 25));

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


    public function destroyWithoutRedirect(Position $position)
    {
        $this->positionService->delete($position);
    }
}
