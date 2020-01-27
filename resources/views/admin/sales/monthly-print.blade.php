<html>
  <head>
    <title>Monthly Sales Report</title>
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
      <h3>
      Monthly report for year
      @if(isset($end))
      {{ $end->format('F Y') }}
      @else
      {{-- THIS MEANS THAT THE RENDERED REPORT IS FROM GENERATE --}}
      {{ Carbon\Carbon::parse(Carbon\Carbon::now())->format('Y') }}
      @endif
      </h3>
      <table class='table-collapse' border='1'>
        <thead>
          <tr>
            <td class='one'></td>
            @foreach($months as $key => $month)
            <td class='one text-center' colspan='2'>{{ $month }}</td>
            @if(isset($end) && $key == $end->format('m'))
            @break
            @endif
            @endforeach
          </tr>
          <tr class='second-header'>
            <th>Food Item</th>
            @foreach($months as $key => $month)
            <td class='two'>Item Sales</td>
            <td class='two'>Quantity</td>
            @if(isset($end) && $key == $end->format('m'))
            @break
            @endif
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
            <td class='text-center'><span class='font-dejavu'>&#8369;</span>{{ $item->price * $item->quantity }}</td>
            <td class='text-center'>{{ $item->quantity }}</td>
            @else
            <td class=''></td>
            <td class=''></td>
            @endif
            @if(isset($end) && $index == $end->format('m'))
            @break
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
            @if(isset($end) && $key == $end->format('m'))
            @break
            @endif
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
    </main>
  </body>
</html>