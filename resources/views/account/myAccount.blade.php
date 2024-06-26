<!doctype html>
<html lang="fr">
<head>
  <title>Mon compte</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="flex flex-col items-center row justify-center col-md-8 mt-2">
  <div class="card-header flex flex-col items-center">
    @if ($user->image != null)
      <div class="relative w-12 h-12 overflow-hidden bg-white rounded-full">
          <img src="/images/{{$user->image->path}}" class="w-full h-full rounded" alt="Photo de profil">
      </div>
    @else
      <div class="relative inline-flex items-center justify-center w-12 h-12 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
        <span class="font-medium text-gray-600 dark:text-gray-300">{{ $user->first_name[0].$user->last_name[0] }}</span>
      </div>
    @endif
    <h1>{{ $user->first_name." ".$user->last_name[0]."." }} </h1>
    <div class="flex items-center">
      <h2>Information personnelles</h2>
      @if(Auth::user() != null)
        @if(Auth::user()->id == $user->id)
          <a href="{{ url('/modifyAccount') }}" class="block py-2 px-3 text-gray-900 rounded">
            <svg class="w-4 h-4"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
            </svg>
          </a>
        @endif
      @endif
    </div>
  </div>
  
  <div class="card-body">
    <div class="row mb-3">
      <label for="last_name" class="col-md-4 col-form-label text-md-end">Prenom  : </label>
      <div class="col-md-6">
          <input id="last_name" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control" name="last_name" value="{{ $user->last_name }}" autofocus readonly="true">
      </div>
    </div>

    <div class="row mb-3">
        <label for="first_name" class="col-md-4 col-form-label text-md-end"> Nom de famille : </label>
        <div class="col-md-6">
            <input id="first_name" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control" name="first_name" value="{{ $user->first_name }}" autofocus readonly="true">
        </div>
    </div>

    <div class="row mb-3">
        <label for="username" class="col-md-4 col-form-label text-md-end"> Nom d'utilisateur : </label>
        <div class="col-md-6">
            <input id="username" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control" name="username" value="{{ $user->username }}" readonly="true" autofocus>
        </div>
    </div>

    <div class="row mb-3">
        <label for="phone" class="col-md-4 col-form-label text-md-end"> Telephone : </label>
        <div class="col-md-6">
            <input id="phone" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control" name="phone" value="{{ $user->phone }}" readonly="true" autofocus>
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end"> Adresse mail : </label>
        <div class="col-md-6">
            <input id="email" type="email" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control" name="email" value="{{ $user->email }}" required readonly="true">
        </div>
    </div>    
  </div>
</div>
@if(Auth::user() != null)
  @if(Auth::user()->id == $user->id)
    <div class="flex justify-center pb-3 pt-2 text-sm md:text-base">
    @if(Auth::user()->seller != null && Auth::user()->customer != null)
      <div class="grid grid-cols-2 gap-4">
          <a href="{{ url('/soldProduct') }}" class="text-center bg-purple-400 rounded-full border-2 border-purple-400 shadow-inner pl-2 pr-2 text-white"> Espace Propriétaire</a>
          <a href="{{ url('/boughtProduct') }}" class=" text-center bg-yellow-400 rounded-full border-2 border-yellow-400 shadow-inner pl-2 pr-2 text-white">Espace Client</a>
      </div>
    @elseif (Auth::user()->customer != null && Auth::user()->seller == null)
      <div class="grid grid-cols-1 gap-4">
          <a href="{{ url('/boughtProduct') }}" class=" text-center bg-yellow-400 rounded-full border-2 border-yellow-400 shadow-inner pl-2 pr-2 text-white w-1/2 m-auto">Espace Client</a>
      </div>
    @elseif (Auth::user()->seller != null && Auth::user()->customer == null)
      <div class="grid grid-cols-1 gap-4">
          <a href="{{ url('/soldProduct') }}" class=" text-center bg-purple-400 rounded-full border-2 border-purple-400 shadow-inner pl-2 pr-2 text-white w-1/2 m-auto">Espace Propriétaire</a>
      </div>
    @endif
    </div>
    <div class="flex justify-center pb-5 pt-2 text-sm md:text-base">
      <a href="{{ url('/logoutAccount') }}" class="text-center bg-red-400 rounded-full border-2 border-red-400 shadow-inner pl-7 pr-7 text-white">Déconnexion</a>
    </div>
  @else
    <div class="flex justify-center pb-5 pt-2 text-sm md:text-base">
      <a href="{{ url('/soldProduct') }}" class="text-center bg-purple-400 rounded-full border-2 border-purple-400 shadow-inner pl-2 pr-2 text-white">Espace Propriétaire</a>
    </div>
  @endif

@else
  <div class="flex justify-center pb-5 pt-2 text-sm md:text-base">
    <a href="{{ url('/soldProduct') }}" class="text-center bg-purple-400 rounded-full border-2 border-purple-400 shadow-inner pl-2 pr-2 text-white">Espace Propriétaire</a>
  </div>
@endif
@include('footer')
</body>
</html>
