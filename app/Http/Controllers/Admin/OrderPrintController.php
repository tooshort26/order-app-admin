<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class OrderPrintController extends Controller
{
    public function __invoke(Request $request)
    {
    	$orders = json_decode($request->customer_orders);
    	// dd($orders);
        $pdf = app('dompdf.wrapper');
    	$pdf->loadView('admin.order.print', compact('orders'));
		return $pdf->stream();
    }
}
