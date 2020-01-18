<?php

namespace App\Http\Repositories;

use App\Http\Repositories\APIRequestAbstract;


class APIFoodRequestRepository extends APIRequestAbstract
{

    public function getFoods()
    {
        $foodRequest = $this->getClient()->request('GET',  self::API_URL . 'sales/foods');
        return json_decode($foodRequest->getBody());
    }
}
