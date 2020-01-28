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
			'1' => 'January',
			'2' => 'February',
			'3' => 'March',
			'4' => 'April',
			'5' => 'May',
			'6' => 'June',
			'7' => 'July',
			'8' => 'August',
			'9' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December',
    	];

        $filteredMonths = [];
        array_walk($months, function (&$value, $key) use ($start,$end, &$filteredMonths) {
            if($start->get('month') <= $key && $key <= $end->get('month')) {
                $filteredMonths[$key] = $value;
            }
        });
       $months = $filteredMonths;



    	$foodData = $this->APIFood->getFoods();

    	Sale::tapSale(
    		$this->APISales->getSales(),
    	);

		$sales =  Sale::orderBy('order_at', 'DESC')
							->whereDate('order_at', '>=', $start)
                            ->whereDate('order_at', '<=', $end)
                            ->get()
                            ->groupBy(function (Sale $sale) {
    			return $sale->order_at->format('m');
    	});

        $existsFoods = $sales->flatten()->pluck('name')->toArray();

    	$foodData = collect($foodData)->filter(function ($value, $key) use($existsFoods) {
            return !in_array($value->name, $existsFoods);
        });


        return view('admin.sales.generated-report', compact('months', 'foodData' , 'sales', 'start', 'end'));
    }

    public function print($start, $end)
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $months = [
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];

        $filteredMonths = [];
        array_walk($months, function (&$value, $key) use ($start,$end, &$filteredMonths) {
            if($start->get('month') <= $key && $key <= $end->get('month')) {
                $filteredMonths[$key] = $value;
            }
        });
       $months = $filteredMonths;



        $foodData = $this->APIFood->getFoods();

        Sale::tapSale(
            $this->APISales->getSales(),
        );

        $sales =  Sale::orderBy('order_at', 'DESC')
                            ->whereDate('order_at', '>=', $start)
                            ->whereDate('order_at', '<=', $end)
                            ->get()
                            ->groupBy(function (Sale $sale) {
                return $sale->order_at->format('m');
        });

        $existsFoods = $sales->flatten()->pluck('name')->toArray();

        $foodData = collect($foodData)->filter(function ($value, $key) use($existsFoods) {
            return !in_array($value->name, $existsFoods);
        });

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.sales.generated-report-print', compact('months', 'foodData' , 'sales', 'start', 'end'))->setPaper('legal', 'landscape');
        return $pdf->stream();
    }



}
