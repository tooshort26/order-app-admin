<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\APIFoodRequestRepository;
use App\Http\Repositories\APISalesRequestRepository;
use App\Sale;
use Illuminate\Http\Request;

class MonthlySalesReportController extends Controller
{
	public function __construct(APIFoodRequestRepository $APIFood, APISalesRequestRepository $APISales)
    {
        $this->APIFood = $APIFood;
        $this->APISales = $APISales;
    }

    public function index()
    {
    	$months = [
			'01' => 'January',
			'02' => 'February',
			'03' => 'March',
			'04' => 'April',
			'05' => 'May',
			'06' => 'June',
			'07' => 'July',
			'08' => 'August',
			'09' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December',
    	];

    	$foodData = $this->APIFood->getFoods();

    	Sale::tapSale(
    		$this->APISales->getSales(),
    	);

    	$existsFoods = Sale::pluck('name')
    						->toArray();

    	$sales = Sale::orderBy('order_at', 'DESC')->get()->groupBy(function (Sale $sale) {
    			return $sale->order_at->format('m');
    	});

    	$foodData = collect($foodData)->filter(function ($value, $key) use($existsFoods) {
            return !in_array($value->name, $existsFoods);
        });

    	return view('admin.sales.monthly', compact('months', 'foodData' , 'sales'));
    }
}
