<!doctype html>
<html lang="fr">
<head>
  <title>Mes historique de commande</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @routes(nonce: Vite::cspNonce())
  @vite('resources/css/app.css')
  @vite(['resources/js/basket.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" nonce="{{ Vite::cspNonce() }}"></script>
</head>
<body class = "">
@include('navbar')
<div class="md:pl-5">
  <a href="{{url('/search') }}"> 
    <p class="font-montserrat">
      < Retour 
    </p>
  </a> 
  <div class="font-montserrat font-bold text-xl pl-15 md:pb-10 pb-4">Mon historique</div>
</div>
<div class="flex">
  <div class="md:w-2/3 md:h-3/6 m-auto" id="allInstrument">
    @foreach ($orders as $order)
      @if($order->instrument->first() != null)
        <div class="rounded-lg overflow-hidden mb-5 md:max-h-68 w-5/6 border-2 border-yellow-400 m-auto" name="{{ $order->instrument->first()->name }}">
          <div class="md:grid md:grid-cols-2">
            @if($order->instrument->first()->image!=null)
              <img src="/images/{{$order->instrument->first()->image[0]->path}}" class="w-72" alt="{{$order->instrument->first()->name}}"/>
            @endif
            <div class="lg:-ml-16 flex items-stretch flex-col">
              <div class="mr-auto">
                <h2 class="font-bold font-montserrat md:text-lg text-sm">Commande n°{{$order->id}}</h2>
                <h2 class="font-bold font-montserrat md:text-lg text-sm">(Etat de la commande : {{$order->status->status}})</h2>
              </div>
              <div class="h-4/5">
                <p class="font-serif md:text-base text-sm">{{ $order->total_price}} €</p>
                <p class="text-ellipsis overflow-hidden md:line-clamp-7 line-clamp-2 font-serif">{{ $order->instrument->first()->description }}</p>
              </div>
              <div class="lg:w-2/5 m-auto pb-2">
                <a href="{{ route('getOrder', ['id' => $order->id]) }}" class="self-end block px-2 py-2 text-center rounded-lg bg-yellow-400 m-auto text-white">Voir la commande</a>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach
  </div>
</div>
@include('footer')
</body>
</html>
