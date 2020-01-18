<?php

namespace App\Http\Repositories;

use App\Http\Repositories\APIRequestAbstract;


class APISalesRequestRepository extends APIRequestAbstract
{

    public function getSales()
    {
    	$salesRequest = $this->getClient()->request('GET',  self::API_URL . 'daily/sales');
		return json_decode($salesRequest->getBody());
    }
}
