<?php 
namespace App\Http\Repositories;

use GuzzleHttp\Client;

abstract class APIRequestAbstract
{
	public const API_URL = 'http://192.168.1.2:3030/';

	public function getClient() : Client
	{
		return new Client();
	}
}