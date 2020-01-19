<?php 
namespace App\Http\Repositories;

use GuzzleHttp\Client;

abstract class APIRequestAbstract
{
	public const API_URL = 'https://mai-place-api.herokuapp.com/';

	public function getClient() : Client
	{
		return new Client();
	}
}