<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="flex">
  <div class="relative flex h-auto w-full max-w-48 flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
    <div class="mt-4 border-t border-gray-200">
      <h3 class="bg-red-50 text-center text-xl">Filtre</h3>
      <ul role="list" class="px-2 py-3 font-medium text-gray-900">
        <li>
          <a href="#" class="block px-2 py-3">Retirer les filtres selectionné</a>
        </li>
        <li>
          <a href="#" class="block px-2 py-3">Prix</a>
        </li>
        <li>
          <a href="#" class="block px-2 py-3">Type</a>
        </li>
        <li>
          <a href="#" class="block px-2 py-3">Marque</a>
        </li>
        <li>
          <a href="#" class="block px-2 py-3">Lieu</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="m-auto">
    <h1 class="text-xl p-10">Derniers ajouts</h1>
    <div class="grid grid-cols-4 gap-2 object-center">
    
      @for ($i = 0; $i < 12; $i++)
        <div class="rounded overflow-hidden shadow-lg w-60" name="{{ $i }}">
              <p class="text-center">Classe</p>
              <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam posuere dignissim ante id rhoncus. Aliquam quis pulvinar libero. Integer id nibh vitae nisi luctus commodo id at eros. Morbi non nulla eu felis viverra placerat. Vivamus semper felis sit amet egestas egestas. Donec hendrerit mauris eget nisi porttitor imperdiet. Aenean.</p>
              <a href="{{ url('/product') }}" class="block px-2 py-3 text-center rounded-lg dark:bg-red-50 m-auto">Voir l'instrument</a>
        </div>
      @endfor
    </div>
  </div>
</div>
@include('footer')
</body>
</html>
