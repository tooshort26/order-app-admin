<?php

namespace App\Http\Controllers\Admin;

use App\Food;
use App\Http\Controllers\Controller;
use App\Http\Repositories\APIFoodRequestRepository;
use App\Http\Repositories\APISalesRequestRepository;
use App\Sale;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DailySalesReportController extends Controller
{
    public function __construct(APIFoodRequestRepository $APIFood, APISalesRequestRepository $APISales)
    {
        $this->APIFood = $APIFood;
        $this->APISales = $APISales;
    }

    public function index()
    {
        $foods = [];
        $existsName = [];
        $salesData = $this->APISales->getSales();

        Sale::tapSale($salesData);

        $foodData = collect($this->APIFood->getFoods());

        $foodData = $foodData->filter(function ($value, $key) use($existsName) {
            return !in_array($value->name, $existsName);
        });

    	$noOfDays = Carbon::now()->daysInMonth;
        $sales = Sale::whereMonth('order_at', '=', Carbon::parse(Carbon::now())->format('m'))->get();
    	return view('admin.sales.daily', compact('noOfDays', 'foodData', 'sales'));
    }

    public function print()
    {
        $foods = [];
        $existsName = [];
        $salesData = $this->APISales->getSales();

        $foodData = collect($this->APIFood->getFoods());

        $foodData = $foodData->filter(function ($value, $key) use($existsName) {
            return !in_array($value->name, $existsName);
        });

        $noOfDays = Carbon::now()->daysInMonth;
        // $noOfDays = 10;
        $sales = Sale::whereMonth('order_at', '=', Carbon::parse(Carbon::now())->format('m'))->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.sales.daily-print', compact('noOfDays', 'foodData', 'sales'));
        return $pdf->stream();

    }
}
