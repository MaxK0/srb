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
    public function __construct(protected BusinessService $businessService)
    {
    }

    public function index()
    {
        $businesses = $this->businessService->getBusinesses();

        return Inertia::render('Business/Index', [
            'businesses' => $businesses
        ]);
    }

    public function show(Business $business)
    {
    }

    public function create()
    {
        
    }

    public function store(StoreRequest $request)
    {
    }

    public function edit(Business $business)
    {
    }

    public function update(Business $business, UpdateRequest $request)
    {
    }

    public function destroy(Business $business)
    {
    }
}