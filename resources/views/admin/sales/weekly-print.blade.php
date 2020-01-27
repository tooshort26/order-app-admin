<html>
  <head>
    <title>Appointment Confirmation</title>
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
     <h3>Weekly report for {{ Carbon\Carbon::parse(Carbon\Carbon::now())->format('F j, Y') }}</h3>
      <table class='table-collapse' border='1'>
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
            <td class='two text-center'>Item Sales</td>
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
            <td class='text-center'><span class='font-dejavu'>&#8369;</span>{{ $s->price * $s->quantity }}</td>
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
    </main>
  </body>
</html>