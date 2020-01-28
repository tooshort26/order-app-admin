<html>
  <head>
    <title>Daily report for {{ Carbon\Carbon::parse(Carbon\Carbon::now())->format('M j, Y') }}</title>
    <style  type="text/css" media="all">
    @page { margin: 20px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .text-center { text-align: center; }
    .table-collapse { border-collapse : collapse; }
    .font-dejavu { font-family : DejaVu Sans; }
    </style>
  </head>
  <body>
    {{--     <header>
      <h2><center>APIT-SUBIRI DENTAL CLINIC</center></h2>
      <center>Abarca Street, Mangagoy, Bislig City, Surigao del Sur</center>
      <center>DR. ELVIE ANGELIE A. SUBERI - Dentist</center>
      <hr>
    </header> --}}
    <main>
      <h1>Daily report for {{ Carbon\Carbon::parse(Carbon\Carbon::now())->format('M j, Y') }} </h1>
      <table border='1' class='table-collapse' style='width : 100%;'>
        <thead>
          <tr>
            <td class='one'></td>
            @for($day = 1; $day<=13; $day++)
            <td class='one text-center' colspan='2'>Day {{ $day }}</td>
            @endfor
          </tr>
          <tr class='second-header'>
            <th>Food Item</th>
            @for($day = 1; $day<=13; $day++)
            <td>Item Sales</td>
            <td><small>Quantity</small></td>
            @endfor
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $sale)
          <tr>
            <td class='food-sale font-weight-bold'>{{ $sale->name }}</td>
            @for($day = 1; $day<=13; $day++)
            @if($sale->order_at->format('d') == $day)
              <td class='text-center'><span class='font-dejavu'>&#8369;</span>{{ $sale->price * $sale->quantity }}</td>
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
            @for($day = 1; $day<=13; $day++)
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            @endfor
          </tr>
          @endforeach
        </tbody>
      </table>
      <br>
      <br>
      <br>
      <br>
      <table border='1' class='table-collapse' style='width : 100%;'>
        <thead>
          <tr>
            <td class='one'></td>
            @for($day = 13; $day<=25; $day++)
            <td class='one text-center' colspan='2'>Day {{ $day }}</td>
            @endfor
          </tr>
          <tr class='second-header'>
            <th>Food Item</th>
            @for($day = 13; $day<=25; $day++)
            <td>Item Sales</td>
            <td><small>Quantity</small></td>
            @endfor
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $sale)
          <tr>
            <td class='food-sale font-weight-bold'>{{ $sale->name }}</td>
            @for($day = 13; $day<=25; $day++)
            @if($sale->order_at->format('d') == $day)
              <td class='text-center'><span class='font-dejavu'>&#8369;</span>{{ $sale->price * $sale->quantity }}</td>
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
            @for($day = 13; $day<=25; $day++)
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            @endfor
          </tr>
          @endforeach
        </tbody>
      </table>

        <br>
      <br>
      <br>
      <br>
      <table border='1' class='table-collapse' style='width : 100%;'>
        <thead>
          <tr>
            <td class='one'></td>
            @for($day = 25; $day<=$noOfDays; $day++)
            <td class='one text-center' colspan='2'>Day {{ $day }}</td>
            @endfor
          </tr>
          <tr class='second-header'>
            <th>Food Item</th>
            @for($day = 25; $day<=$noOfDays; $day++)
            <td>Item Sales</td>
            <td><small>Quantity</small></td>
            @endfor
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $sale)
          <tr>
            <td class='food-sale font-weight-bold'>{{ $sale->name }}</td>
            @for($day = 25; $day<=$noOfDays; $day++)
            @if($sale->order_at->format('d') == $day)
              <td class='text-center'><span class='font-dejavu'>&#8369;</span>{{ $sale->price * $sale->quantity }}</td>
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
            @for($day = 25; $day<=$noOfDays; $day++)
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            @endfor
          </tr>
          @endforeach
        </tbody>
      </table>
    </main>
  </body>
</html>