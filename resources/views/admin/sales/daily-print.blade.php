<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>

td.one {
  position: sticky;
  top: -20px;
  font-weight : bold;
}

td.two {
   position: sticky;
   top: 5px;
   font-weight : bold;
}
  </style>
</head>
<body>
  <h5>Daily report for {{ Carbon\Carbon::parse(Carbon\Carbon::now())->format('M j, Y') }} <button class='btn btn-sm btn-primary' id='btnPrintDaily'> Print</button></h5>
  <table class='table table-bordered table-hover'>
  <thead>
    <tr>
        <td class='one'></td>
        @for($day = 1; $day<=$noOfDays; $day++)
          <td class='one text-center' colspan='2'>Day {{ $day }}</td>
        @endfor
     </tr>
    <tr class='second-header'>
        <th>Food Item</th>
        @for($day = 1; $day<=$noOfDays; $day++)
          <td class='two'>Item Sales</td>
          <td class='two'>Quantity</td>
        @endfor
    </tr>
  </thead>
  <tbody>
     @foreach($sales as $sale)
        <tr>
          <td class='food-sale font-weight-bold'>{{ $sale->name }}</td>
          @for($day = 1; $day<=$noOfDays; $day++)
            @if($sale->order_at->format('d') == $day)
              <td class='text-center'>&#8369;{{ $sale->price * $sale->quantity }}</td>
              <td class='text-center'>{{ $sale->quantity }}</td>
              @else
              <td></td>
              <td></td>
            @endif
          @endfor
        </tr>
      @endforeach
       @foreach($foodData as $food)
        <tr>
          <td class='food-sale'>{{ $food->name }}</td>
          @for($day = 1; $day<=$noOfDays; $day++)
              <td>&nbsp;</td>
              <td>&nbsp;</td>
          @endfor
        </tr>
      @endforeach
  </tbody>
</table>
</body>
</html>