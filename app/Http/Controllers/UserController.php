<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\FindRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

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
}
