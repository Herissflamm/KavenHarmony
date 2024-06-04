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
<div class="pl-5 pb-5">
  <h1 class="font-bold text-xl font-serif flex justify-center pb-2">Merci !</h1>
  <h1 class="font-bold text-xl font-serif flex justify-center">Votre commande a été effectué avec succès !</h1>
</div>

<div class="pl-5 pb-5">
  <h1 class="font-montserrat flex justify-center pb-2">Vous pouvez maintenant contacter le/les vendeur(s) :</h1>
  @foreach ($sellers as $seller)
  <div class="font-montserrat text-lg flex justify-center items-center pb-2 text-center">
    <div>
      <h1 class="font-serif">{{$seller->last_name}} {{$seller->first_name}}</h1>
      <p class="font-montserrat">{{$seller->phone}}</p>
      <p class="font-montserrat">{{$seller->email}}</p>
    </div>
  </div>
  @endforeach
</div>
@include('footer')
</body>
</html>
