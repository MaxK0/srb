<?php

namespace App\Services;

use App\Filters\ClientFilter;
use App\Models\Client;

class ClientService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Client::class);
    }


    public function dataForIndex(ClientFilter $filter): array
    {
        

        return [];
    }


    public function dataForShow(): array
    {
        return [];
    }

    /**
     * Владелец -> записать клиента -> поиск по телефону или email 
     * -> если пользователь найден, но не найден клиент (clients) то переходит в attachUserToClient для прикрепления этого пользователя к клиентам (и только, заказ делается в OrderService)
     * -> если пользователь не найден, то createWithUser
     * -> если и пользователь, и клиент найдены, то ничего, ведь ClientService отвечает только за создание и просмотр клиентов 
     */
    public function attachUserToClients() {}


    public function createWithUser() {}
}
