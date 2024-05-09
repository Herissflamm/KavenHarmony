<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="container flex flex-col items-center row justify-center col-md-8 card">
  <div class="card-header">
    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
      <span class="font-medium text-gray-600 dark:text-gray-300">{{ $user->first_name[0].$user->last_name[0] }}</span>
    </div>
    <h1>{{ $user->first_name." ".$user->last_name[0]."." }} </h1>
    <div class="inline-grid grid-cols-2">
      <h2>Information personnelles</h2>
      <a href="{{ url('/modifyAccount') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-100 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
        <svg class="w-4 h-4"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
        </svg>
      </a>
    </div>
  </div>
  
  <div class="card-body">
    <div class="row mb-3">
        <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Nom de famille') }} : </label>
        <div class="col-md-6">
            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" autofocus readonly="true">
        </div>
    </div>
    <div class="row mb-3">
      <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Prenom') }} : </label>
      <div class="col-md-6">
          <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" autofocus readonly="true">
      </div>
    </div>

    <div class="row mb-3">
        <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }} : </label>
        <div class="col-md-6">
            <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" readonly="true" autofocus>
        </div>
    </div>

    <div class="row mb-3">
        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Telephone') }} : </label>
        <div class="col-md-6">
            <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" readonly="true" autofocus>
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }} : </label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required readonly="true">
        </div>
    </div>
  </div>
  <a href="{{ url('/boughtProduct') }}">Espace Client</a>
  <a href="{{ url('/soldProduct') }}">Espace Professionnel</a>
</div>
</body>
</html>
