<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @routes
  @vite('resources/css/app.css')
  @vite(['resources/js/basket.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="flex">
  <div class="m-auto">
    <h1 class="text-xl p-10">Mon Panier</h1>
    <div class="grid grid-cols-4 gap-2 object-center" id="allInstrument">
      @foreach ($instruments as $instrument)
        <div class="rounded overflow-hidden shadow-lg w-60" name="{{ $instrument->getName() }}">
          <svg class="h-8 w-8 float-right" id="{{ $instrument->getId()}}" name="cross" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="18" y1="6" x2="6" y2="18" />  
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
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
