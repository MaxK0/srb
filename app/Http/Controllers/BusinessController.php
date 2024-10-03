<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\StoreRequest;
use App\Http\Requests\Business\UpdateRequest;
use App\Models\Owner\Business;
use App\Services\BusinessService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BusinessController extends Controller
{
    public function __construct(protected BusinessService $businessService) {}

    public function index()
    {
        $businesses = $this->businessService->getUserBusinesses();

        return Inertia::render('Business/Index', [
            'businesses' => $businesses
        ]);
    }

    public function show(Business $business)
    {
        return Inertia::render('Business/Show', [
            'business' => $business
        ]);
    }

    public function create()
    {
        $data = $this->businessService->dataForCreate();

        return Inertia::render('Business/Create', $data);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->safe()->collect();

        $this->businessService->create($data);

        return redirect()->route('businesses.index');
    }

    public function edit(Business $business)
    {
        return Inertia::render('Business/Edit', [
            'business' => $business
        ]);
    }

    public function update(UpdateRequest $request, Business $business)
    {
        $data = $request->validated();

        $this->businessService->update($business, $data);

        return redirect()->route('businesses.index');
    }

    public function destroy(Business $business)
    {
        $this->businessService->delete($business);
    }
}
