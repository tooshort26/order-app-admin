<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CancelledOrderController extends Controller
{
    public function index()
    {
    	return view('admin.order.cancelled');
    }
}
