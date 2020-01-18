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
  <table class='table table-bordered table-hover'>
  <thead>
    <tr>
        <td class='one'></td>
        @foreach($months as $month)
          <td class='one text-center' colspan='2'>{{ $month }}</td>
        @endforeach
     </tr>
    <tr class='second-header'>
        <th>Food Item</th>
        @foreach($months as $month)
          <td class='two'>Profit</td>
          <td class='two'>Quantity</td>
        @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach($sales as $month => $data)
      @foreach($data as $item)
        <tr>
            <td class='text-center font-weight-bold'>{{ $item->name }}</td>
            @foreach($months as $index => $m)
              @if($month == $index)
                <td class='two text-center'>&#8369;{{ $item->price * $item->quantity }}</td>
                <td class='two text-center'>{{ $item->quantity }}</td>
              @else
                <td class='two'></td>
                <td class='two'></td>
              @endif

            @endforeach
        </tr>
      @endforeach
   @endforeach   
    @foreach($foodData as $food)
        <tr>
          <td class='food-sale'>{{ $food->name }}</td>
          @foreach($months as $month)
            <td class='two'></td>
            <td class='two'></td>
          @endforeach
        </tr>
   @endforeach   
  </tbody>
</table>
</body>
</html>