<?php

namespace App\Http\Controllers;

use App\Filters\PositionFilter;
use App\Services\BranchService;
use App\Services\PositionService;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct(protected PositionService $positionService,
        protected BranchService $branchService)
    {        
    }

    public function index(Request $request, PositionFilter $filter)
    {
        // TODO: заместо того, чтобы брать все branches через owner->businesses, нужно скачать пакет для более сложных связей
        $businesses = auth()
            ->user()
            ->owner()
            ->first()
            ->businesses()
            ->get();

        dd($businesses);

        $positions = $this->positionService
            ->branchPositions($filter);
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
