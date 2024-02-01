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
    
    <div class = "grid grid-cols-2 gap-3 place-items-center">
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <p class="text-center px-6 pt-4 pb-2">Classe</p>
            <p class="text-center px-6 pt-4 pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam posuere dignissim ante id rhoncus. Aliquam quis pulvinar libero. Integer id nibh vitae nisi luctus commodo id at eros. Morbi non nulla eu felis viverra placerat. Vivamus semper felis sit amet egestas egestas. Donec hendrerit mauris eget nisi porttitor imperdiet. Aenean.</p>
        </div>
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <p class="text-center px-6 pt-4 pb-2">Achat et revente</p>
            <p class="text-center px-6 pt-4 pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut sapien vitae elit laoreet ornare ut et eros. Aenean vel magna malesuada, congue nunc vitae, ultrices ipsum. Proin porta felis id tempor feugiat. Nam eu ipsum nisl. Duis dignissim dolor eu metus ultricies, in molestie magna efficitur. Nam ut dapibus.</p>
        </div>
    </div>
    <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a nunc ut nisl porttitor ullamcorper nec eget velit. Aliquam sed diam eget velit vehicula sagittis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur fringilla velit sit amet vehicula volutpat. Curabitur ornare turpis vitae velit consequat, non faucibus quam vestibulum. Ut venenatis eros eget nulla condimentum, sit amet laoreet risus facilisis. Integer elementum, felis eu molestie molestie, nulla eros pretium lectus, euismod pellentesque felis tortor dignissim diam. Proin sapien nulla, malesuada ut arcu in, auctor commodo dolor. Mauris et tortor est. Quisque sodales nulla nec sollicitudin rhoncus. Etiam et quam rutrum, pretium nulla quis, molestie augue. Cras quis blandit ligula. In eget ultrices enim. Maecenas rhoncus urna in lacus ornare, commodo euismod est ultricies. Praesent vehicula arcu vel tellus suscipit, a cursus est congue.</p>
@include('footer')
</body>
</html>
