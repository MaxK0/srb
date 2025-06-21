<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Models\Owner\Branch;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index(Request $request, Branch $branch)
    {
        $services = [];
        $branch = null;

        if ($branchId = request()->cookie('branch_id')) {
            $branch = Branch::find($branchId);

            $services = $branch->services()
                ->select('id', 'title', 'price', 'duration', 'active', 'information')
                ->paginate($request->get('perPage', 25))
                ->withQueryString();
        }

        return Inertia::render('Service/Index', [
            'services' => $services,
            'branch' => $branch
        ]);
    }

    public function show(Service $service)
    {
        return Inertia::render('Service/Show', [
            'service' => $service->load('branch:id,title')
        ]);
    }

    public function store(StoreRequest $request, Branch $branch)
    {
        $data = $request->validated();

        $service = $branch->services()->create($data);

        return redirect()->route('branches.services.index', $branch);
    }

    public function create(Branch $branch)
    {
        return Inertia::render('Service/Create', [
            'branch' => $branch->only('id', 'title')
        ]);
    }

    public function edit(Service $service)
    {
        return Inertia::render('Service/Edit', [
            'service' => $service,
            'branch' => $service->branch->only('id', 'title')
        ]);
    }

    public function update(UpdateRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('branches.services.index', $service->branch);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('branches.services.index', $service->branch);
    }
}
