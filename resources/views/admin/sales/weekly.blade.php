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
   top: 20px;
   font-weight : bold;
}
  </style>
</head>
<body>
  <table class='table table-bordered table-hover'>
  <thead>
    <tr>
        <td class='one'></td>
        @for($week = 0; $week<$weeks; $week++)
          <td class='one text-center' colspan='2'>Week {{ $week +1 }} <br> {{ $periods[$week][0]->format('M d Y') }} - {{ $periods[$week][6]->format('M d Y') }}</td>
        @endfor
     </tr>
    <tr class='second-header'>
        <th>Food Item</th>
        @for($week = 1; $week<=$weeks; $week++)
          <td class='two text-center'>Profit</td>
          <td class='two text-center'>Quantity</td>
        @endfor
    </tr>
  </thead>
  <tbody>
    @foreach($sales as $saleWeek => $sale)
      @foreach($sale as $s) 
        <tr>
          <th>{{ $s->name }}</th>
          @for($week = 0; $week<$weeks; $week++)
          @if($saleWeek == $week)
              <td class='text-center'>&#8369;{{ $s->price * $s->quantity }}</td>
              <td class='text-center'>{{ $s->quantity }}</td>
            @else
              <td>&nbsp;</td>
              <td>&nbsp;</td>
          @endif
              
          @endfor
        </tr>
      @endforeach
    @endforeach
   @foreach($foodData as $food)
        <tr>
          <td class='food-sale'>{{ $food->name }}</td>
          @for($week = 0; $week<$weeks; $week++)
              <td>&nbsp;</td>
              <td>&nbsp;</td>
          @endfor
        </tr>
   @endforeach
  </tbody>
</table>
</body>
</html>