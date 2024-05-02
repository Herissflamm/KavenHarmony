<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite('resources/css/app.css')
  @vite(['resources/js/filter.js'])
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="flex">
  <div class="m-auto">
    <h1 class="text-xl p-10">Derniers ajouts</h1>
    <div class="grid grid-cols-4 gap-2 object-center" id="allInstrument">
      @foreach ($instruments as $instrument)
        <div class="rounded overflow-hidden shadow-lg w-60" name="{{ $instrument->getName() }}">
              <p class="text-center">{{ $instrument->getType()->getType() }}</p>
              <p class="text-center">{{ $instrument->getState()->getState() }}</p>
              @if($instrument->getImage()!=null)
                <img src="/images/{{$instrument->getImage()[0]->getPath()}}" class="w-24"/>
              @endif
              <p class="text-center">{{ $instrument->getSell()->getPrice()}} €</p>
              <a href="{{ route('product', ['id' => $instrument->getId()]) }}" class="block px-2 py-3 text-center rounded-lg dark:bg-red-50 m-auto">Voir l'instrument</a>
        </div>
      @endforeach
    </div>
  </div>
</div>
@include('footer')
</body>
</html>
