<html>
	<head>
		<title>Receipt</title>
		<style>
		@page { margin: 100px 130px; }
		header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; }
		footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
		p { page-break-after: always; }
		p:last-child { page-break-after: never; }
		.text-center { text-align:center; }
		.font-weight-bold { font-weight: bold; }
		.text-right { text-align: right; }
		.text-left { text-align: left; }
		.underline {
			width : 100%;
			border-bottom : 1px solid black;
		}
		table {
			border-top : 1px solid black;
			border-left : 1px solid black;
			border-right : 1px solid black;
			border-bottom : 1px solid black;
			width : 100%;
			border-collapse : collapse;
		}
		table > thead { font-weight : bold; }
		 tr , td {
			padding : 7px;
			border-bottom : 1px solid black;
		}
		.receipt-seperator {
			width : 100%;
			border-top : 2px dashed black;
		}
		.float-right {
			float : right;
		}
		.float-left  {
			float : left;
		}
		.clear {
			clear : both;
		}
		.text-capitalize {
			text-transform :capitalize;
		}
		</style>
	</head>
	<body>
		<header>
			<h3><center>MAI PLACE BISLIG</center></h3>
			<div style='margin-top : -20px;'>
				<center><small>8311 Bislig, Surigao del Sur</small></center>
			</div>
		</header>
		<main>
			<h3>Order #: {{ request('order_no') }}</h3>
			<div class="customer-details">
					<span class='font-weight-bold float-left'>Name : </span>
					<span class='font-weight-bold float-right'>Address : </span>
					<div class='clear'></div>
					<span class='float-left capitalize'>{{ ucfirst(request('customer_name'))}}</span>
					<span class='float-right'> {{ ucfirst(request('customer_address') ) }}</span>
					<br>
					<br>
					<span class='font-weight-bold float-left'>Phone Number : </span>
					<span class='font-weight-bold float-right'>Order Date : </span>
					<div class='clear'></div>
					<span class='float-left'>{{ request('customer_phone_number') }}</span>
					<span class='float-right'> {{ request('customer_order_date') }}</span>
					<br>
					<br>
					<span class='font-weight-bold float-left'>Order Type : </span>
					<br>
					<span class='float-left'>{{ ucfirst(request('order_type')) }}</span>
			</div>
			<h3>Order Summary</h3>
			@php $subTotal = 0 @endphp
			<table class='table'>
				<thead>
					<tr>
						<td>Item</td>
						<td>Price</td>
						<td>Quantity</td>
						<td>Totals</td>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
						@foreach($order->order_food as $food)
							@php $subTotal += $food->price * $order->quantity @endphp
							<tr>
								<td>{{ $food->name }}</td>
								<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{ $food->price }}</td>
								<td>{{ $order->quantity }}</td>
								<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{  $food->price * $order->quantity }}</td>
							</tr>
						@endforeach
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<td><b>Total</b></td>
						<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{ $subTotal }}</td>
					</tr>
				</tbody>
			</table>
			<br>
			<div class="receipt-seperator"></div>
			<br>
			<p></p>
			<h3>Order copy for Kitchen</h3>
			<table class='table'>
				<thead>
					<tr>
						<td>Item</td>
						<td>Quantity</td>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
						@foreach($order->order_food as $food)
							<tr>
								<td>{{ $food->name }}</td>
								<td>{{ $order->quantity }}</td>
							</tr>
						@endforeach
					@endforeach
				</tbody>
			</table>
			<br>
			<div class="receipt-seperator"></div>
			<p></p>
			<br>
			<h3>Order Summary for Management</h3>
			@php $subTotal = 0 @endphp
			<table class='table'>
				<thead>
					<tr>
						<td>Item</td>
						<td>Price</td>
						<td>Quantity</td>
						<td>Totals</td>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
						@foreach($order->order_food as $food)
							@php $subTotal += $food->price * $order->quantity @endphp
							<tr>
								<td>{{ $food->name }}</td>
								<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{ $food->price }}</td>
								<td>{{ $order->quantity }}</td>
								<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{  $food->price * $order->quantity }}</td>
							</tr>
						@endforeach
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<td><b>Total</b></td>
						<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{ $subTotal }}</td>
					</tr>
				</tbody>
			</table>
			<br>
			<div class="receipt-seperator"></div>
			<p></p>
			<br>
			<h3>Order Summary for Delivery boy</h3>
			@php $subTotal = 0 @endphp
			<table class='table'>
				<thead>
					<tr>
						<td>Item</td>
						<td>Price</td>
						<td>Quantity</td>
						<td>Totals</td>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
						@foreach($order->order_food as $food)
							@php $subTotal += $food->price * $order->quantity @endphp
							<tr>
								<td>{{ $food->name }}</td>
								<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{ $food->price }}</td>
								<td>{{ $order->quantity }}</td>
								<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{  $food->price * $order->quantity }}</td>
							</tr>
						@endforeach
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<td><b>Total</b></td>
						<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{ $subTotal }}</td>
					</tr>
				</tbody>
			</table>
			<br>
			<div class="receipt-seperator"></div>
			<p></p>
			<br>
			<h3>Order Summary for Cashier</h3>
			@php $subTotal = 0 @endphp
			<table class='table'>
				<thead>
					<tr>
						<td>Item</td>
						<td>Price</td>
						<td>Quantity</td>
						<td>Totals</td>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
						@foreach($order->order_food as $food)
							@php $subTotal += $food->price * $order->quantity @endphp
							<tr>
								<td>{{ $food->name }}</td>
								<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{ $food->price }}</td>
								<td>{{ $order->quantity }}</td>
								<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{  $food->price * $order->quantity }}</td>
							</tr>
						@endforeach
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<td><b>Total</b></td>
						<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{ $subTotal }}</td>
					</tr>
				</tbody>
			</table>
		</main>
	</body>
</html>