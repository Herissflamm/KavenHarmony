<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
  <div class="mt-4 border-t border-gray-200">
    <h3 class="sr-only">Filtre</h3>
    <ul role="list" class="px-2 py-3 font-medium text-gray-900">
      <li>
        <a href="#" class="block px-2 py-3">Prix</a>
      </li>
      <li>
        <a href="#" class="block px-2 py-3">Backpacks</a>
      </li>
      <li>
        <a href="#" class="block px-2 py-3">Travel Bags</a>
      </li>
      <li>
        <a href="#" class="block px-2 py-3">Hip Bags</a>
      </li>
      <li>
        <a href="#" class="block px-2 py-3">Laptop Sleeves</a>
      </li>
    </ul>
  </div>
</div>
@include('footer')
</body>
</html>
