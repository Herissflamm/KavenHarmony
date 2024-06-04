<!doctype html>
<html lang="fr">
<head>
  <title>Page produit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" nonce="{{ Vite::cspNonce() }}"></script>
  @vite('resources/css/app.css')
  @vite(['resources/js/modal.js'])
</head>
<body class="overflow-x-hidden">
@include('navbar')
@if($errors->any())
<div class="rounded-lg z-10 absolute m-auto right-30 top-50 bg-yellow-400 bg-opacity-100 overflow-y-auto p-3 text-center" id="modalError">
  <div class="pb-2" >
    <svg id="crossError" class="absolute top-0 right-0 h-8 w-8 text-black"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
      <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" />
    </svg>  
  </div>
  <h4 class="text-xl text-white font-serif">{{$errors->first()}}</h4>
</div>
@endif
<div class="rounded-lg z-10 absolute hidden m-auto right-40 top-50 bg-yellow-400 bg-opacity-100 overflow-y-auto p-3 text-center" id="modalDate">
  <div class="pb-2" id="crossDate">
    <svg class="absolute top-0 right-0 h-8 w-8 text-black"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
      <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" />
    </svg>  
  </div>  
  <form method="POST" action="{{ url('/addToBasketRent') }}" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
      <input type="hidden" class="hidden" name="instrument" value="{{$instrument->id}}"></input>
      <label for="date" class="col-md-4 col-form-label text-md-end text-white font-bold">Designez la date de fin de location : </label>
      <div class="pt-2">
        <input id="date_max" type="date" class="pl-2 pr-1 rounded-full shadow-inner border-2 form-control @error('date_max') is-invalid @enderror" name="date_max" value="{{ old('date_max') }}" required autocomplete="date_max" autofocus> 
      </div>
    </div>
    <button class="text-white bg-purple-400 rounded-full py-1 px-2" type="submit">Louer le produit</button>
  </form>
</div>
<img src="/logo/disquerouge.png" class="absolute top-100 right-10" alt="Disque rouge">
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
  <div class="bg-purple-400 rounded-r-2xl text-white min-h-60">
    <h1 class="text-xl font-montserrat font-bold pl-10">Description</h1>
    <p class="pl-10 p-5 text-ellipsis overflow-auto max-h-96">{{$instrument->description}}</p>
  </div>
  <div class="pl-40">
    <div class="rounded-lg border-2 border-yellow-400 bg-yellow-400 grid grid-cols-2 w-9/12 h-44">
      @if ($instrument->seller->users->image != null)
        <div class="relative w-40 h-40 m-2 overflow-hidden bg-white rounded-full">
          <img src="/images/{{$instrument->seller->users->image->path}}" class="w-full h-full object-fill rounded" src="Photo de profil">
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
          <div class="text-purple-400 border-2 rounded-full items-center bg-white flex justify-center pl-1 pr-1">
            <a href="{{ route('accountSeller', ['id' => $instrument->seller->users->id]) }}">
              <span class="font-serif">Voir le compte</span>
            </a>
          </div>
        </div> 
      </div>
    </div>
    <p class="pl-14 text-xs">Publié depuis le {{$instrument->created_at}}</p>
    <div class="relative">
      @if($instrument->sell != null)
        <h2>A vendre</h2>
        <p class="font-bold font-montserrat">{{$instrument->sell->price}} €</p>
      @elseif($instrument->rent != null)
        <h2 class="font-bold font-serif">A louer</h2>
        <p class="font-bold font-montserrat">{{$instrument->rent->price}} €/{{$instrument->rent->frequency->frequency}}</p>
        <p class="font-montserrat">Date de maximum de fin de location : {{$instrument->rent->duration_max}}</p>
      @endif
      
    </div>
    <div class="font-montserrat relative">
      Etat : 
      {{$instrument->state->state}}
    </div>
      @if(Auth::user() != null)
        @if(Auth::user()->customer != null)
          @if($instrument->order->isEmpty())
          <div class="text-center w-9/12 relative">
            @if($instrument->sell != null)
              <a href="{{ route('addToBasket', ['id' => $instrument->id]) }}" class="font-serif text-xl font-bold text-white border-purple-400 bg-purple-400 rounded-full px-4 py-1" id="btn">Ajouter au panier</a>
            @elseif($instrument->rent != null)
              <button class="btn font-serif text-xl font-bold text-white border-purple-400 bg-purple-400 rounded-full px-4 py-1" id="btn">Louer</button>
            @endif
          </div>
          @endif
        @endif
      @endif          
  </div>
</div>
<h1 class="font-serif font-bold pl-20 text-xl pb-5">Images du produit</h1>
<div class="flex items-center pt-2 pb-5 pl-20">
  
  @foreach ($instrument->image as $image)
  <div>
    <img src="/images/{{$image->path}}" class="w-48 h-48 object-fill pr-5" alt="{{$instrument->name}}"/>
  </div>
  @endforeach
</div>
<div class="pb-3 pl-20">
  <h1 class="font-montserrat font-bold text-xl pb-5">Suggestion</h1>
  <div class="grid grid-cols-5 gap-2 ">
    @foreach ($suggestInstrument as $instrument)
    <div class="rounded overflow-hidden shadow-lg w-60" name="{{ $instrument->name }}">
        <div class="w-52 h-52">
          @if($instrument->image)
            <img src="/images/{{$instrument->image[0]->path}}" class="object-fill w-52 h-52" alt="{{$instrument->name}}"/>
          @endif
        </div>
        <div class="grid grid-cols-2 pb-2">
          <div class="text-left">
            <p class="">{{ $instrument->type_instrument->type }}</p>
            @if($instrument->sell != null)
              <p class="">{{ $instrument->sell->price}} €</p>
            @elseif($instrument->rent != null)
              <p class="">{{ $instrument->rent->price}} €/{{$instrument->rent->frequency->frequency}}</p>
            @endif
          </div>
          @if(Auth::user() != null)
            @if(Auth::user()->customer != null)
              @if($instrument->order->isEmpty())
                @if($instrument->sell != null)
                  <div class="rounded-full text-purple-400 bg-white flex justify-end items-center p-1">
                    <a href="{{ route('addToBasket', ['id' => $instrument->id]) }}">
                      <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="file: h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                      </div>
                    </a>
                  </div>
                @elseif($instrument->rent != null)
                  <div class="rounded-full text-purple-400 bg-white flex justify-end items-center p-1">
                    <a href="{{ route('addToBasketRent', ['id' => $instrument->id]) }}">
                      <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="file: h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                      </div>
                    </a>
                  </div>                  
                @endif
              @endif
            @endif
          @endif
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
@include('footer')
</body>
</html>
