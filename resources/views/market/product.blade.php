<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="overflow-x-hidden">
@include('navbar')
<img src="/logo/disquerouge.png" class="absolute top-96 right-10">
<div class="pl-20">
  <a href="{{url('/search') }}"> 
    <p class="font-montserrat">
      < Retour 
    </p>
  </a> 
</div>
<div class="flex">
  <h1 class="font-montserrat font-bold pl-20 text-xl">{{$instrument->name}}</h1>
  @if(Auth::user() != null)
    @if(Auth::user()->id == $instrument->seller->id_users)
      <a href="{{ route('modifyProduct', ['instrument' => $instrument->id]) }}" class="block py-2 px-3 text-gray-900 rounded">
        <svg class="w-4 h-4"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
        </svg>
      </a>
    @endif
  @endif
</div>
<h2 class="font-montserrat pl-20 text-lg">{{$instrument->type_instrument->type}}</h2>
<div class="grid grid-cols-2 gap-28">
  <div class="bg-purple-400 rounded-r-lg text-white min-h-60">
    <h1 class="text-xl font-montserrat font-bold pl-10">Description</h1>
    <p class="pl-10 p-5 text-ellipsis overflow-auto max-h-96">{{$instrument->description}}</p>
  </div>
  <div class="pl-40">
    <div class="rounded-lg border-2 border-yellow-400 bg-yellow-400 grid grid-cols-2 w-9/12 h-44">
      @if ($instrument->seller->users->image->path != null)
        <div class="relative w-40 h-40 m-2 overflow-hidden bg-white rounded-full">
          <img src="/images/{{$instrument->seller->users->image->path}}" class="w-full h-full object-fill rounded">
        </div>
      @else
        <div class="relative w-44 h-5/6 m-2 overflow-hidden bg-white rounded-full">
          <svg class="absolute w-5/6 h-5/6 text-yellow-400 left-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
          </svg>
        </div>
      @endif
      
      <div class="relative">
        <h1 class="text-white text-4xl font-montserrat pb-5 text-center m-auto pr-12 pt-5">{{$instrument->seller->users->last_name}} {{$instrument->seller->users->first_name[0]}}.</h1>
        <div class="flex m-auto bottom-0 absolute pb-2">
          @if(Auth::user() != null)
            @if(Auth::user()->customer != null)
              <div class="mr-3 text-purple-400 border-2 w-14 rounded-full items-center bg-white flex justify-center">
                <a href="{{ route('addToBasket', ['id' => $instrument->id]) }}">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="file: h-8 w-8">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                  </svg>
                </a>
              </div>
            @endif
          @endif
          <div class="text-purple-400 border-2 rounded-full items-center bg-white flex justify-center pl-1 pr-1">
            <a href="{{ route('accountSeller', ['id' => $instrument->seller->users->id]) }}">
              <span class="font-serif">Voir le compte</span>
            </a>
          </div>
        </div> 
      </div>
    </div>
    <p class="pl-14">Publié depuis le {{$instrument->created_at}}</p>
    <div>
      <p class="font-bold text-white">{{$instrument->sell->price}} €</p>
    </div>
    <div>
      Etat : 
      {{$instrument->state->state}}
    </div>
  </div>
</div>
<h1 class="font-montserrat font-bold pl-20 text-xl pb-5">Images du produit</h1>
<div class="flex items-center pt-2 pb-5 pl-20">
  
  @foreach ($instrument->image as $image)
  <div>
    <img src="/images/{{$image->path}}" class="w-48 h-48 object-fill pr-5"/>
  </div>
  @endforeach
</div>
<div>
  <h1 class="font-montserrat font-bold pl-20 text-xl pb-5">Suggestion</h1>
  <div class="grid grid-cols-5 gap-3 pl-20">
    @foreach ($suggestInstrument as $instrument)
    <div class="rounded overflow-hidden shadow-lg w-60" name="{{ $instrument->name }}">
        <div class="w-52 h-52">
          @if($instrument->image)
            <img src="/images/{{$instrument->image[0]->path}}" class="object-fill w-52 h-52"/>
          @endif
        </div>
        <div class="grid grid-cols-2 pb-2">
          <div class="text-left">
            <p class="">{{ $instrument->type_instrument->type }}</p>
            <p class="text-white">{{ $instrument->sell->price}} €</p>
          </div>
          @if(Auth::user() != null)
            @if(Auth::user()->customer != null)
              <div class="rounded-full text-purple-400 bg-white flex justify-end items-center p-1">
                  <a href="{{ route('addToBasket', ['id' => $instrument->id]) }}">
                    <div class="relative">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="file: h-6 w-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                      </svg>
                    </div>
                  </a>
                </div>
              </div>
            @endif
          @endif
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
@include('footer')
</body>
</html>
