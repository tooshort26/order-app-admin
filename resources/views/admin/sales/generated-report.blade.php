<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
body { padding :5px; }
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
  <h5 class='text-center'>
    Monthly report for year {{ $start->format('F Y')}} to {{ $end->format('F Y')}}
    <br>
    <a href="/admin/generate/report/{{$start->format('Y-m-d')}}/{{$end->format('Y-m-d')}}/print" class='btn btn-primary btn-sm'>Print</a>
  </h5>
  <hr>
  <table class='table table-bordered table-hover'>
  <thead>
    <tr>
        <td class='one'></td>
        @foreach($months as $key => $month)
          <td class='one text-center' colspan='2'>{{ $month }}</td>
        @endforeach
     </tr>
    <tr class='second-header'>
        <th>Food Item</th>
        @foreach($months as $key => $month)
          <td class='two'>Item Sales</td>
          <td class='two'>Quantity</td>
        @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach($sales as $month => $data)
      @foreach($data as $item)
        <tr>
            <td class='font-weight-bold'>{{ $item->name }}</td>
            @foreach($months as $index => $m)
              @if($month == $index)
                <td class='text-center'>&#8369;{{ $item->price * $item->quantity }}</td>
                <td class='text-center'>{{ $item->quantity }}</td>
              @else
                <td class=''></td>
                <td class=''></td>
              @endif

     

            @endforeach
        </tr>
      @endforeach
   @endforeach   
    @foreach($foodData as $food)
        <tr>
          <td class='food-sale'>{{ $food->name }}</td>
          @foreach($months as $key => $month)
            <td class='two'></td>
            <td class='two'></td>
          @endforeach
        </tr>
   @endforeach   
  </tbody>
</table>
</body>
</html>