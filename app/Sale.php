<?php

namespace App;

use App\Sale;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	public $timestamps = false;
	protected $fillable = ['customer_id', 'order_no', 'order_type', 'order_at', 'quantity', 'price', 'name'];
	protected $dates = ['order_at'];


	public static function tapSale($salesData)
	{
		foreach($salesData as $sale) {
		    foreach ($sale->foods as $food) {
		        $existsName[] = $food->order_food[0]->name;
		        $saleObject = Sale::firstOrCreate(
		            [
		                'customer_id' => $sale->customer_id,
		                'name' => $food->order_food[0]->name,
		                'order_at' => Carbon::parse($sale->created_at),
		            ],
		            [
		                'customer_id'  => $sale->customer_id,
		                'order_no' => $sale->order_no,
		                'order_at' => Carbon::parse($sale->created_at),
		                'order_type' => $sale->order_type,
		                'quantity' => $food->quantity,
		                'price' => $food->order_food[0]->price,
		                'name' => $food->order_food[0]->name,
		            ]
		        );
		    }
		}
	}
}
