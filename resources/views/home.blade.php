<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
    <div class="w-2/5 m-auto">
        <h1 class="text-2xl text-center font-bold font-montserrat">
            Bienvenue sur notre plateforme !
        </h1>
        <div class="font-serif text-lg">
        <p>Kaven Harmony est une platfeforme consacrée au partage de la musique. Vous pourrez ici louer vos instruments de musique ou bien prendre contact avec des professeurs pour apprendre à jouer d'un instrument.</p>
        <br>
        <p>Grâce à la location, réservez des instruments à prix moindre pour une durée déterminée.</p>     
        <p>Vous pouvez également acheter directement des instruments et des accessoires de musique via le catalogue.</p>
        <br>
        <p>Si vous souhaitez apprendre à jouer d'un instrument, Kaven Harmony vous propose de prendre contact avec un large éventail de professeurs de tout horizon.</p>
        </div>
    </div>
    
    <div class = "grid grid-cols-2 gap-3 place-items-center font-montserrat">
        <a href="{{ url('/home') }}"> 
            <div class="relative max-w-xl mx-auto mt-20">
                <img src="/logo/piano.jpeg" class="h-64 w-full object-cover rounded-md"/>
                <div class="absolute inset-0 flex items-center justify-center">
                    <p class="text-white text-3xl font-bold">Location</p>
                </div>
            </div>
        </a>
        <a href="{{ url('/home') }}"> 
            <div class="relative max-w-xl mx-auto mt-20">
                <img src="/logo/piano.jpeg" class="h-64 w-full object-cover rounded-md"/>
                <div class="absolute inset-0 flex items-center justify-center">
                    <p class="text-white text-3xl font-bold">Achat</p>
                </div>
            </div>
        </a>
    </div>
    <br>
    <div class="grid grid-cols-4 gap-2">
        <div>
            <img src="/logo/ordit.webp" class=""/>
        </div>
        <div>
            <img src="/logo/carton.webp" class=""/>
        </div>
        <div>
            <img src="/logo/louer.webp" class=""/>
        </div>
        <div>
            <img src="/logo/jouer.webp" class=""/>
        </div>        
    </div>
    <div class="">
        <h1 class="font-montserrat font-bold">Nos actualités</h1>
        <div class="grid grid-cols-4 gap-2">
            <div class="font-serif  m-auto">
                <img src="/logo/partition.jpeg" class="w-48"/>
                <h2>Lire une tablature</h2>
                <p clas="text-xs">Date de publication : 01/03/2024</p>
            </div>
            <div class="font-serif  m-auto">
                <img src="/logo/kazoo.png" class="w-48"/>
                <h2>Le Kazoo</h2>
                <p clas="text-xs">Date de publication : 20/12/2023</p>
            </div>
            <div class="font-serif  m-auto">
                <img src="/logo/piano.jpeg" class="w-48"/>
                <h2>Le Piano quand t'as pas..</h2>
                <p clas="text-xs">Date de publication : 06/06/2024</p>
            </div>
            <div class="font-serif  m-auto">
                <img src="/logo/trompette.jpeg" class="w-48"/>
                <h2>Saxophone vs Tropett..</h2>
                <p clas="text-xs">Date de publication : 15/05/2024</p>
            </div>  
        </div>
    </div>
@include('footer')
</body>
</html>
