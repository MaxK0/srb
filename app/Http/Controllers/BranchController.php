<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\StoreRequest;
use App\Http\Requests\Branch\UpdateRequest;
use App\Models\Owner\Branch;
use App\Services\BranchService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BranchController extends Controller
{
    public function __construct(protected BranchService $branchService)
    {        
    }  
    
    public function create()
    {
        $data = $this->branchService->dataForCreate();

        return Inertia::render('Branch/Create', $data);
    }

    
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $branch = $this->branchService->create($data);

        return redirect()->route('businesses.show', $branch->business_id);
    }

    
    public function show(Branch $branch)
    {
        return Inertia::render('Branch/Show', [
            'branch' => $branch->load('business')
        ]);
    }

    
    public function edit(Branch $branch)
    {
        $data = $this->branchService->dataForEdit($branch);

        return Inertia::render('Branch/Edit', $data);
    }

    
    public function update(UpdateRequest $request, Branch $branch)
    {
        $data = $request->validated();

        $this->branchService->update($branch, $data);

        return redirect()->route('businesses.show', $branch->business_id);
    }

    
    public function destroy(Branch $branch)
    {
        $this->branchService->delete($branch);

        return redirect()->route('businesses.show', $branch->business_id);
    }
}
