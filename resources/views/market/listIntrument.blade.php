<!doctype html>
<html lang="fr">
<head>
  <title>Liste instrument</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @routes
  @vite('resources/css/app.css')
  @vite(['resources/js/filter.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>  
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="flex">
  <div class="relative flex w-full max-w-56 flex-col overflow-y-auto bg-white py-4 pb-12 shadow-x overflow-hidden">
    <div class="mt-4 border-t h-auto border-gray-200 border-2 rounded-lg shadow-inner">
      <h3 class="bg-purple-400 text-center text-xl rounded-tr-lg text-white">Filtre</h3>
      <ul role="list" class="px-2 py-3 font-medium text-gray-900">
        <li>
          <a href="#" class="block px-2 py-3 cursor-pointer" id="clearFilter">Retirer les filtres selectionné</a>
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
                    class="absolute  appearance-none z-20 h-2 w-11/12 opacity-0 cursor-pointer">

              <input type="range" 
                    step="1"
                    id="maxPrice"
                    value="{{$biggestPrice}}"
                    min="0" max="{{$biggestPrice}}"
                    class="absolute pointer-events-none appearance-none z-20 h-2 w-11/12 opacity-0 cursor-pointer">

              <div class="relative z-10 h-2">

                <div class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200"></div>

                <div id ="barthumb" class="absolute z-20 top-0 bottom-0 rounded-md bg-black-50" style="right:0%; left: 0%"></div>

                <div id="minthumb" class="absolute z-30 w-6 h-6 top-0 left-0 bg-black-50 rounded-full -mt-2 -ml-1" style="left: 0%"></div>

                <div id="maxthumb"class="absolute z-30 w-6 h-6 top-0 right-0 bg-black-50 rounded-full -mt-2 -mr-3" style="right: 0%"></div>
        
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
          Categories
          @foreach ($allCategories as $categories)
            <ul role="list" class="px-2 py-2" id="{{$categories->categories}}">{{$categories->categories}}
            @foreach ($allType as $type)
              @if ($type->id_categories == $categories->id)
                <li class="font-normal pl-2 hidden cursor-pointer" id="{{ $type->type }}" name="Type">
                  {{$type->type}}
                </li>
              @endif
            @endforeach
          </ul>
          @endforeach
        </li>
        <li>
          <ul role="list" class="px-2 py-3">Etat
          @foreach ($allState as $state)
            <li class="font-normal pl-3 cursor-pointer" id="{{ $state->state }}" name="State">
              {{$state->state}}
            </li>
          @endforeach
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <div class="m-auto">
    <h1 class="text-xl p-10 text-center">Derniers ajouts</h1>
    <div class="grid grid-cols-4 gap-2 object-center" id="allInstrument">
      @foreach ($instruments as $instrument)
      <div class="rounded overflow-hidden shadow-lg w-60" name="{{ $instrument->name }}">
        <div class="w-52 h-52">
          @if($instrument->image)
            <img src="/images/{{$instrument->image[0]->path}}" class="object-fill w-52 h-52" alt="{{$instrument->name}}"/>
          @endif
        </div>
        <div class="grid grid-cols-2 pb-2">
          <div class="text-left">
            <p class="font-montserrat text-lg">{{ $instrument->name }}</p>
            <p class="font-serif">{{ $instrument->sell->price}} €</p>
          </div>
          <div class="rounded-full text-purple-400 bg-white flex justify-end items-center p-1">
            @if(Auth::user())
              @if(Auth::user()->customer != null)            
                <a href="{{ route('addToBasket', ['id' => $instrument->id]) }}">
                  <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="file: h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                  </div>
                </a>
              @endif
            @endif
          </div>
        </div>
        <div class="flex justify-center">
          <a  href="{{ route('product', ['id' => $instrument->id]) }}">
            <button class="rounded-full bg-yellow-400 p-1 pl-2 pr-2 text-white mb-1">
              Voir l'instrument
            </button>     
          </a>
        </div>   
      </div>
      @endforeach
    </div>
  </div>
</div>
@include('footer')
</body>
</html>
