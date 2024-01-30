<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
    <h1 class="text-center font-bold ">
        KavenHarmony
    </h1>
    <p class="text-center">Kaven Harmony est un site de achats et de revente d'instruments de musique d'occasion. Ici, vous pouvez revendre vos instruments non utilisé et acheté de nouveaux instruments à un prix abordable.</p>
    <div class = "grid grid-cols-2 gap-3 place-items-center">
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <p class="text-center px-6 pt-4 pb-2">Classe</p>
        </div>
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <p class="text-center px-6 pt-4 pb-2">Achat et revente</p>
            <p class="text-center px-6 pt-4 pb-2">Revendez vos vieux instruements et acheté des nouveaux ici.</p>
        </div>
    </div>
</body>
</html>
