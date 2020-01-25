<?php 
namespace App\Http\Repositories;

use App\Http\Repositories\APIRequestAbstract;
use App\Sale;
use Illuminate\Database\Eloquent\Collection;

class YearlySalesRepository extends APIRequestAbstract
{
	private $MONTHS = [];

	public function __construct(APISalesRequestRepository $APISales)
	{
		$this->APISales = $APISales;
		$this->MONTHS = [
	        'January', 'February', 'March',
			'April', 'May', 'June',
			'July', 'August', 'September',
			'October', 'November', 'December'
		];
	}

	public function init()
	{
		$salesData = $this->APISales->getSales();
        Sale::tapSale($salesData);
        $yearlySales = Sale::orderBy('order_at', 'ASC')->whereYear('order_at', date('Y'))
        		->get(['quantity', 'price', 'order_at'])
        		->groupBy(function (Sale $sale) {
                	return $sale->order_at->format('F');
        		});
		
		return $this->prepareDataForChart($yearlySales);
	}




	private function prepareDataForChart(Collection $sales)
	{
		$monthsWithData = $sales->keys()->toArray();
		
		foreach ($monthsWithData as $month) {
			$monthKeyInListMonth = array_search($month, $this->MONTHS);
			unset($this->MONTHS[$monthKeyInListMonth]);
		}

		// Rebase the values of the array after deleting some element.
		$this->MONTHS = array_values($this->MONTHS);

		// Insert 0 Values for all months that has no data.
		foreach ($this->MONTHS as $key => $month) {

			// Remove each of the generated range month.
			unset($this->MONTHS[$key]);

			// Insert new with 0 value.
			$this->MONTHS[$month] = 0.0;
		}

		foreach($sales as $month => $sale) {
			$totalSale = 0;
			foreach ($sale as $s) {
				$totalSale = $s->price * $s->price;
			}
			$this->MONTHS[$month] = $totalSale;
		}

		$yearlyData = [];
		array_walk($this->MONTHS, function ($value, $key) use(&$yearlyData) {
			$index = (int) date('m', strtotime($key));
			$yearlyData[$index] = $value;
		});
		
		// sort month by it's index;
		ksort($yearlyData);

		return array_values($yearlyData);
	}
}