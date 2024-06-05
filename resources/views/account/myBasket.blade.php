<!doctype html>
<html lang="fr">
<head>
  <title>Mon panier</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @routes(nonce: Vite::cspNonce())
  @vite('resources/css/app.css')
  @vite('resources/js/basket.js')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" nonce="{{ Vite::cspNonce() }}"></script>
</head>
<body>
@include('navbar')
<div class="pl-5">
  <a href="{{url('/search') }}"> 
    <p class="font-montserrat">
      < Retour 
    </p>
  </a> 
  <div class="font-montserrat m-auto pb-10 text-center">
    @if($order != null)
      @if($order->status->status == 'Panier')
        <h1 class="font-bold text-xl">Mon Panier</h1>
      @elseif($order->status->status == 'Terminé')
        <h1 class="font-bold text-xl">Ma commande terminé</h1>
      @else
        <h1 class="font-bold text-xl">Ma commande en cours</h1>
      @endif
      <h1 class="text-lg" id="id_order" value="{{$order->id}}">Numéro de commande : {{$order->id}} </h1>
      <h2 class="text-lg" id="price_order">Prix total : {{$order->total_price}} €</h2>
    @endif
  </div>
</div>
<div class="flex">
  <div class="w-2/3 h-3/6 m-auto" id="allInstrument">
    @if($order != null)
      @foreach ($order->instrument as $instrument)
        <div class="rounded-lg overflow-hidden mb-5 max-h-68 w-5/6 border-2 border-yellow-400 m-auto" name="instrument" id="{{ $instrument->name }}">
          <div class="grid grid-cols-2">
            @if($instrument->image!=null)
              <img src="/images/{{$instrument->image[0]->path}}" class="w-72"/>
            @endif
            <div class="-ml-16 flex items-stretch flex-col">
              
              <div class="flex mb-5 justify-between">
                <h2 class="text-left">{{$instrument->name}}</h2>
                @if($order->status->status == "Panier")
                  <svg id="{{$instrument->id}}" name="crossBasket" class=" h-8 w-8 text-black"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" />
                  </svg> 
                @endif 
              </div>
              <div class="h-4/5">
                @if($instrument->sell != null)
                  <p class="mb-5">{{ $instrument->sell->price}} €</p>
                @elseif($instrument->rent != null)
                  <p class="mb-5">{{ $instrument->rent->price}} €/{{$instrument->rent->frequency->frequency}}</p>
                @endif
                <p class="text-ellipsis overflow-hidden line-clamp-7">{{ $instrument->description }}</p>
              </div>
              <div class="w-2/5 m-auto mb-2">
                <a href="{{ route('product', ['id' => $instrument->id]) }}" class="self-end block px-2 py-2 text-center rounded-lg bg-yellow-400 m-auto text-white">Voir l'instrument</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      @if($order->status->status == 'Panier' && !$order->instrument->isEmpty())
        <div class="flex justify-center pb-2 " id="accept_button">
          <a href="{{ route('validate', ['id' => $order->id]) }}" class="text-white border-yellow-400 bg-yellow-400 rounded-full px-2 py-1">Valider la commande</a>
        </div>
      @endif
    @else
    <div class="text-center m-auto pb-10">
      <p class="font-bold">Panier vide</p>
    </div>
    @endif
  </div>
</div>
@include('footer')
</body>
</html>
