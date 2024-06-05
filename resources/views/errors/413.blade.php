@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '413')
@section('message', __('Server Error'))
<!doctype html>
<html lang="fr">
<head>
  <title>Erreur</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="overflow-x-hidden">
@include('navbar')
<div class="flex justify-center items-center">
    <div class="text-center pb-2">
        <h1 class="font-serif text-xl font-bold pb-2">Erreur 413 - La taille des fichiers est trop élevée</h1>
        <p class="font-montserrat text-lg pb-2">Désolé, une erreur est survenu, contactez l'administrateur.</p>
        <a class="font-montserrat text-lg pb-2 border-2 border-purple-400 bg-purple-400 rounded-full p-1" href="{{ url('/') }}">Retournez à l'accueil</a>
    </div>
</div>
@include('footer')
</body>
</html>
