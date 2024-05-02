<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @routes
  @vite('resources/css/app.css')
  @vite(['resources/js/filter.js'])
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>  
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="flex">
  <div class="relative flex h-auto w-full max-w-48 flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
    <div class="mt-4 border-t border-gray-200">
      <h3 class="bg-red-50 text-center text-xl">Filtre</h3>
      <ul role="list" class="px-2 py-3 font-medium text-gray-900">
        <li>
          <a href="#" class="block px-2 py-3" id="clearFilter">Retirer les filtres selectionné</a>
        </li>
        <li>
        <div class="flex justify-center items-center">
          <div id="priceDiv">
            <div>
              <input type="range"
                    step="1"
                    id="minPrice"
                    value="0"
                    min="0" max="{{$biggestPrice}}"
                    class="absolute  appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

              <input type="range" 
                    step="1"
                    id="maxPrice"
                    value="{{$biggestPrice}}"
                    min="0" max="{{$biggestPrice}}"
                    class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

              <div class="relative z-10 h-2">

                <div class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200"></div>

                <div id ="barthumb" class="absolute z-20 top-0 bottom-0 rounded-md bg-black" style="right:0%; left: 0%"></div>

                <div id="minthumb" class="absolute z-30 w-6 h-6 top-0 left-0 bg-black rounded-full -mt-2 -ml-1" style="left: 0%"></div>

                <div id="maxthumb"class="absolute z-30 w-6 h-6 top-0 right-0 bg-black rounded-full -mt-2 -mr-3" style="right: 0%"></div>
        
              </div>

            </div>
            
            <div class="flex justify-between items-center py-5">
              <div>
                <input type="text" id="minPriceInput" maxlength="5" value="0" class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
              </div>
              <div>
                <input type="text" id="maxPriceInput" maxlength="5" value="{{$biggestPrice}}" class="px-3 py-2 border border-gray-200 rounded w-24 text-center">
              </div>
            </div>
            
          </div>
        </li>
        <li>
          <ul role="list" class="px-2 py-3">Type
          @foreach ($allType as $type)
            <li class="font-normal" id="{{ $type->getType() }}" name="Type">
              {{$type->getType()}}
            </li>
          @endforeach
          </ul>
        </li>
        <li>
          <ul role="list" class="px-2 py-3">Etat
          @foreach ($allState as $state)
            <li class="font-normal" id="{{ $state->getState() }}" name="State">
              {{$state->getState()}}
            </li>
          @endforeach
          </ul>
        </li>
        <li>
          <a href="#" class="block px-2 py-3">Marque</a>
        </li>
        <li>
          <a href="#" class="block px-2 py-3">Lieu</a>
        </li>
      </ul>
    </div>
  </div>
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
