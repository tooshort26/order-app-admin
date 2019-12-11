<?php
namespace App\Http\Contracts;

use Illuminate\Http\Request;

interface IUploader
{
	public function uploader(Request $request);
}