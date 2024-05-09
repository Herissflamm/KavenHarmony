<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<a href="{{url('/search') }}"> < Retour </a> 
<div class="grid grid-cols-5 gap-2">
  @foreach ($instrument->getImage() as $image)
  <div class=>
    <img src="/images/{{$image->getPath()}}"/>
  </div>
  @endforeach
  <div class="col-span-2 grid grid-cols-3 gap-2 rounded border-2">
    <img src="/images/Plan_de_travail_7-100.jpg" class="rounded-full"/>
    <h1 class="col-span-2">{{$instrument->getSeller()->getlast_name()}} {{$instrument->getSeller()->getfirst_name()}}</h1>
    <a href="{{ route('addToBasket', ['id' => $instrument->getId()]) }}">
      <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12.3 6A2 2 0 0 0 14 9h1v1a2 2 0 0 0 3 1.7l-.3 1.5a1 1 0 0 1-1 .8h-8l.2 1H16a3 3 0 1 1-2.8 2h-2.4a3 3 0 1 1-4-1.8L4.7 5H4a1 1 0 0 1 0-2h1.5c.5 0 .9.3 1 .8L6.9 6h5.4Z"/>
        <path d="M18 4a1 1 0 1 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0V8h2a1 1 0 1 0 0-2h-2V4Z"/>
      </svg>
    </a>
    <a href="{{ url('/home') }}">
      <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
        <path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8c0 .6.4 1 1 1h1v2a1 1 0 0 0 1.7.7L9.4 13H15c.6 0 1-.4 1-1V4c0-.6-.4-1-1-1H4Z" clip-rule="evenodd"/>
        <path fill-rule="evenodd" d="M8 17.2h.1l2.1-2.2H15a3 3 0 0 0 3-3V8h2c.6 0 1 .4 1 1v8c0 .6-.4 1-1 1h-1v2a1 1 0 0 1-1.7.7L14.6 18H9a1 1 0 0 1-1-.8Z" clip-rule="evenodd"/>
      </svg>
    </a>
  </div>
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
</div>
@include('footer')
</body>
</html>
