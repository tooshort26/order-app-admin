<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\APIFoodRequestRepository;
use App\Http\Repositories\APISalesRequestRepository;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
	public function __construct(APIFoodRequestRepository $APIFood, APISalesRequestRepository $APISales)
	{
		$this->APIFood = $APIFood;
		$this->APISales = $APISales;
	}

    public function index()
    {
    	$salesData = $this->APISales->getSales();
        Sale::tapSale($salesData);
    	return view('admin.sales.generate');
    }

    public function generate(Request $request)
    {
    	request()->validate([
            'from_date' => ['date', 'before:to_date'],
            'to_date'   => ['date', 'after:from_date'],
        ]);

        $start = Carbon::parse($request->from_date);
        $end = Carbon::parse($request->to_date);
    	
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

		$sales =  Sale::orderBy('order_at', 'DESC')
							->whereDate('order_at', '>=', $start)
                            ->whereDate('order_at', '<=', $end)
                            ->get()
                            ->groupBy(function (Sale $sale) {
    			return $sale->order_at->format('m');
    	});

    	$foodData = collect($foodData)->filter(function ($value, $key) use($existsFoods) {
            return !in_array($value->name, $existsFoods);
        });

        return view('admin.sales.monthly', compact('months', 'foodData' , 'sales', 'start', 'end'));

    }
}
