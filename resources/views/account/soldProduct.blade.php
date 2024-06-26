<!doctype html>
<html lang="fr">
<head>
  <title>Mes produit mis en vente</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @routes(nonce: Vite::cspNonce())
  @vite('resources/css/app.css')
  @vite(['resources/js/basket.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" nonce="{{ Vite::cspNonce() }}"></script>
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="md:pl-5">
  <a href="{{url('/search') }}"> 
    <p class="font-montserrat">
      < Retour 
    </p>
  </a> 
  <div class="font-montserrat font-bold text-xl m-auto md:pb-10 pb-4">Mes articles en vente</div>
</div>
<div class="flex">
  <div class="md:w-2/3 md:h-3/6 m-auto" id="allInstrument">
    @foreach ($instruments as $instrument)
      
      <div class="rounded-lg overflow-hidden mb-5 md:max-h-68 w-5/6 border-2 border-purple-400 m-auto" name="{{ $instrument->name }}">
        <div class="md:grid md:grid-cols-2">
          @if($instrument->image!=null)
            <img src="/images/{{$instrument->image[0]->path}}" class="w-72" alt="{{$instrument->name}}"/>
          @endif
          <div class="lg:-ml-16 flex items-stretch flex-col">
            <div class="flex items-center justify-between">
              <h2 class="font-bold font-serif md:text-lg text-sm">{{$instrument->name}}</h2>
            </div>
            
            <div class="h-4/5">
              @if($instrument->sell != null)
                <p class="font-montserrat md:text-base text-sm">{{ $instrument->sell->price}} €</p>
              @elseif($instrument->rent != null)
              <p class="font-montserrat">{{ $instrument->rent->price}} €/{{ $instrument->rent->frequency->frequency}}</p>
              @endif
              <p class="text-ellipsis overflow-hidden md:line-clamp-7 line-clamp-2 font-serif">{{ $instrument->description }}</p>
            </div>
            <div class="lg:w-2/5 m-auto pb-2">
              <a href="{{ route('product', ['id' => $instrument->id]) }}" class="self-end block px-2 py-2 text-center rounded-lg bg-purple-400 m-auto text-white">Voir l'instrument</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@include('footer')
</body>
</html>
