<?php

namespace App\Http\Controllers;

use App\Filters\ClientFilter;
use App\Http\Requests\Client\StoreRequest;
use App\Models\Client;
use App\Models\User\User;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService) {}


    public function index(ClientFilter $filter)
    {
        $data = $this->clientService->dataForIndex($filter);

        return Inertia::render('Client/Index', $data);
    }


    public function create() {}


    public function store(StoreRequest $request) {}


    public function attachUserToClients(int $userId) {}


    public function show(Client $client) {}
}
