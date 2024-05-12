<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="pl-20">
  <a href="{{url('/search') }}"> 
    <p class="font-montserrat">
      < Retour 
    </p>
  </a> 
</div>
<h1 class="font-montserrat font-bold pl-20 text-xl">{{$instrument->getName()}}</h1>
<div class="grid grid-cols-2 gap-28">
  <div class="bg-purple-400 rounded-r-lg text-white">
    <h1 class="text-xl font-montserrat font-bold pl-20">Description</h1>
    <br>
    <p class="pl-20 p-5 text-ellipsis overflow-auto max-h-96">{{$instrument->getDescription()}}</p>
  </div>
  <div class="rounded border-2 bg-yellow-400">
    <img src="/images/Plan_de_travail_7-100.jpg" class="rounded-full"/>
    <h1 class="text-white text-6xl font-montserrat">{{$instrument->getSeller()->getlast_name()}} {{$instrument->getSeller()->getfirst_name()}}</h1>
    <div class="text-purple-400 border-2 w-24 rounded-full items-center bg-white flex items-center justify-center">
      <a href="{{ route('addToBasket', ['id' => $instrument->getId()]) }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="file: h-16 w-16">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </svg>
      </a>
    </div>
  </div>
</div>
@foreach ($instrument->getImage() as $image)
<div>
  <img src="/images/{{$image->getPath()}}"/>
</div>
@endforeach
<div>
  <h2>Description</h2>
  <p>{{$instrument->getDescription()}}</p>
</div>
<div>
  Etat
  <br>
  {{$instrument->getState()->getState()}}
</div>
<div>
  Prix : 
  <br>
  {{$instrument->getSell()->getPrice()}}
</div>
@include('footer')
</body>
</html>
