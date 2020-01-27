<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\APIFoodRequestRepository;
use App\Sale;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class WeeklySalesReportPrintController extends Controller
{
    public const MONDAY = 0;
	public const SUNDAY = 6;

	public function __construct(APIFoodRequestRepository $APIFood)
    {
        $this->APIFood = $APIFood;
    }

    public function print()
    {
    	
		$secondDate = Carbon::now();
		$firstDate  = Carbon::now();

		// API request for foods in server.
        $foodData = collect($this->APIFood->getFoods());

		// Get the first date of month
		$startOfMonth = $firstDate->startOfMonth();
		// Get the last date of month
		$endOfMonth   = $secondDate->endOfMonth();

		// Generate Period by two dates
		$period = CarbonPeriod::create($startOfMonth->startOfWeek(), $endOfMonth->endOfWeek());

		// Group by Weeks
		$periods = array_chunk($period->toArray(), 7);

		// Count how many weeks on generated period
		$weeks = count($periods);

		// Request to Database
		$sales = [];
		foreach ($periods as $datePeriod) {
			$sales[] = Sale::whereDate('order_at', '>=', $datePeriod[self::MONDAY])
                                    ->whereDate('order_at', '<=', $datePeriod[self::SUNDAY])
                                    ->get();	
		}

		// Filter the weeks that no value.
		$sales = collect($sales)->filter(function ($value) {
			return count($value) !== 0;
		});

		$pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.sales.weekly-print', compact('weeks', 'foodData', 'periods', 'sales'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
