<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<a href="{{url('/search') }}"> < Retour </p>
<div class="grid grid-cols-5 gap-2">
  <div class=>
    <img src="/images/Plan_de_travail_7-100.jpg"/>
  </div>
  <div class=>
    <img src="/images/Plan_de_travail_7-100.jpg"/>
  </div>
  <div class=>
    <img src="/images/Plan_de_travail_7-100.jpg"/>
  </div>
  <div class="col-span-2">
    <img src="/images/Plan_de_travail_7-100.jpg"/>
  </div>

</div>
@include('footer')
</body>
</html>
