<?php

namespace App\Http\Controllers;

use App\Services\WorkdayService;
use Illuminate\Http\Request;

class WorkdayController extends Controller
{
    public function __construct(protected WorkdayService $workdayService) {}
}
