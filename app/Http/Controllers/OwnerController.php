<?php

namespace App\Http\Controllers;

use App\Services\OwnerService;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function __construct(protected OwnerService $ownerService) {}

    public function becomeOwner()
    {
        $this->ownerService->becomeOwner();

        return redirect()->route('schedule.index');
    }
}
