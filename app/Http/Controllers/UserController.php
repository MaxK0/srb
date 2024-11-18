<?php

namespace App\Http\Controllers;

use App\Filters\PositionFilter;
use App\Http\Requests\User\FindRequest;
use App\Http\Requests\User\HireRequest;
use App\Models\User\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}


    public function find(FindRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->find($data);

        if (!$user) return back()->withErrors([
            'submit' => 'Пользователь не найден'
        ]);

        return back()->with([
            'user' => $user
        ]);
    }


    public function hire(User $user, PositionFilter $filter)
    {
        $data = $this->userService->dataForHire($filter);

        $data['user'] = $user;

        return Inertia::render('Employee/Hire', $data);
    }


    public function hireStore(HireRequest $request, User $user)
    {
        $data = $request->validated();

        $this->userService->hire($data, $user);

        return redirect()->route('employees.index');
    }
}
