<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      @foreach ($ingenieros as $ingeniero )
        <b>{{$ingeniero['nombre']}}</b>
        {{$ingeniero['especialidad']}}<br>
      @endforeach
      {{-- {{$data[1]}} --}}
  </body>
</html>
