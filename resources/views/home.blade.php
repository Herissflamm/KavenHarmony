<!doctype html>
<html lang="fr">
<head>
    <title>Home page</title>
    <meta name="description" content="Kaven Harmony est un site d'achat et revente d'instrument de musique d'occasion">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://kavenharmony.eu">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Home page">
    <meta property="og:description" content="Kaven Harmony : site d'achat et revente d'instrument de musique d'occasion">
    <meta property="og:image" content="/logo/logotypenoir.png">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="kavenharmony.eu">
    <meta property="twitter:url" content="https://kavenharmony.eu">
    <meta name="twitter:title" content="Home page">
    <meta name="twitter:description" content="Kaven Harmony : site d'achat et revente d'instrument de musique d'occasion">
    <meta name="twitter:image" content="/logo/logotypenoir.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <div class="overflow-x-hidden">
        @include('navbar')
        <div class="relative">
            <img src="/logo/disquejaune.png" class="md:absolute md:top-20 md:-right-45 md:w-auto w-2/3 m-auto" alt="Disque jaune">

            <img src="/logo/disquerouge.png" class="absolute md:top-[20%] md:-left-45 md:w-auto w-2/3 hidden lg:block" alt="Disque rouge">

            <div class="md:pt-5 lg:w-2/5 md:w-4/5 m-auto relative">
                <h1 class="md:text-2xl text-center font-bold font-serif pb-2">
                    Bienvenue sur notre plateforme !
                </h1>
                <div class="md:pt-2 font-montserrat text-lg text-center">
                    <p>Kaven Harmony est une platfeforme consacrée au partage de la musique. Vous pourrez ici louer vos instruments de musique ou bien prendre contact avec des professeurs pour apprendre à jouer d'un instrument.</p>
                <br>
                    <p>Grâce à la location, réservez des instruments à prix moindre pour une durée déterminée.</p>     
                    <p>Vous pouvez également acheter directement des instruments et des accessoires de musique via le catalogue.</p>
                <br>
                    <p>Si vous souhaitez apprendre à jouer d'un instrument, Kaven Harmony vous propose de prendre contact avec un large éventail de professeurs de tout horizon.</p>
                </div>
            </div>


            
            <div class = "relative md:grid md:grid-cols-2 md:gap-3 md:place-items-center">
                <div class="relative max-w-xl mx-auto md:mt-20 mt-5">
                    <a href="{{ url('/search') }}"> 
                        <img src="/logo/piano.jpeg" class="h-2/5 w-full object-cover rounded-md brightness-25" alt="Piano"/>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h1 class="text-white text-5xl font-bold font-serif">Location</h1>
                        </div>
                    </a>
                </div>
                
                
                <div class="relative max-w-xl mx-auto md:mt-20 mt-5">
                    <a href="{{ url('/search') }}"> 
                        <img src="/logo/guitare.jpeg" class="h-2/5 w-full object-cover rounded-md brightness-25" alt="Guitare"/>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h1 class="text-white text-5xl font-bold font-serif">Achat</h1>
                        </div>
                    </a>
                </div>
            </div>
            <br>
            <div class="md:grid md:grid-cols-4 md:gap-1 ml-20 md:visible hidden">
                <div>
                    <img src="/logo/ordit.webp" class="w-3/5" alt="Homme devant un écran"/>
                </div>
                <div>
                    <img src="/logo/carton.webp" class="w-3/5" alt="Homme mettant une trompette dans un carton"/>
                </div>
                <div>
                    <img src="/logo/louer.webp" class="w-3/5" alt="Homme louant une trompette à une femme"/>
                </div>
                <div>
                    <img src="/logo/jouer.webp" class="w-3/5" alt="Femme jouant de la trompette"/>
                </div>        
            </div>
            <div class="md:ml-20">
                <h1 class="font-serif font-bold md:pb-0 pb-2 text-xl">Nos actualités</h1>
                <div class="md:grid md:grid-cols-4 md:gap-2">
                    <div class="font-serif m-auto md:text-start text-center">
                        <img src="/logo/partition.jpeg" class="md:w-3/5" alt="Partition"/>
                        <h2 class="font-serif">Lire une tablature</h2>
                        <p class="font-montserrat text-xs">Date de publication : 01/03/2024</p>
                    </div>
                    <div class="font-serif m-auto md:text-start text-center">
                        <img src="/logo/kazoo.png" class="md:w-3/5" alt="Garçon jouant du kazoo"/>
                        <h2 class="font-serif">Le Kazoo</h2>
                        <p class="font-montserrat text-xs">Date de publication : 20/12/2023</p>
                    </div>
                    <div class="font-serif m-auto md:text-start text-center">
                        <img src="/logo/piano.jpeg" class="md:w-3/5" alt="Piano"/>
                        <h2 class="font-serif">Le Piano quand t'as pas..</h2>
                        <p class="font-montserrat text-xs">Date de publication : 06/06/2024</p>
                    </div>
                    <div class="font-serif m-auto md:text-start text-center">
                        <img src="/logo/trompette.jpeg" class="md:w-3/5" alt="Trompette"/>
                        <h2 class="font-serif">Saxophone vs Tropett..</h2>
                        <p class="font-montserrat text-xs">Date de publication : 15/05/2024</p>
                    </div>  
                </div>
            </div>
        </div>
        <img src="/logo/disquerouge.png" class="w-2/3 m-auto md:hidden" alt="Disque rouge">
        @include('footer')
    </div>
</body>
</html>
