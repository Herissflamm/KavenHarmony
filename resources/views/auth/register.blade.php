<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50 ">
@include('navbar')
<div class="flex flex-col items-center pt-2 pb-2">
    <div class="w-10 h-10 overflow-hidden">
        <svg class="w-10 h-10 text-yellow-400 rounded-full border-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
    </div>
    <div class="card-header">
        <h1 class="font-montserrat font-bold text-xl">Inscription</h1>
    </div>
    <div class="justify-center items-center">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col items-center">
                <div class="row mb-3">
                    <label for="first_name" class="col-md-4 col-form-label text-md-end">Nom :</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="family-name" autofocus>

                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="last_name" class="col-md-4 col-form-label text-md-end">Prénom :</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="given-name">

                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="username" class="col-md-4 col-form-label text-md-end">Nom d'utilisateur :</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required >

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-form-label text-md-end">Numéro de téléphone :</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="tel">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Adresse mail :</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="jeandupont@gmail.com" autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="city" class="col-md-4 col-form-label text-md-end"> Ville : </label>

                    <div class="col-md-6">
                        <input id="city" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">

                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="post_code" class="col-md-4 col-form-label text-md-end">Code Postal : </label>

                    <div class="col-md-6">
                        <input id="post_code" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('post_code') is-invalid @enderror" name="post_code" value="{{ old('post_code') }}" required autocomplete="postal-code">

                        @error('post_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="street_number" class="col-md-4 col-form-label text-md-end"> Numéro de rue : </label>

                    <div class="col-md-6">
                        <input id="street_number" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('street_number') is-invalid @enderror" name="street_number" value="{{ old('street_number') }}" required autocomplete="street-number">

                        @error('street_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="street_name" class="col-md-4 col-form-label text-md-end"> Rue : </label>

                    <div class="col-md-6">
                        <input id="street_name" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('street_name') is-invalid @enderror" name="street_name" value="{{ old('street_name') }}" required>

                        @error('street_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Mot de passe </label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('password') is-invalid @enderror" name="password" required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmer le mot de passe</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="-ml-20 row mb-3">
                    <label for="images" class="col-md-4 col-form-label text-md-end">Photo de profil : </label>

                    <div class="flex items-center pt-2">
                        <div id="image-preview" class="flex items-center">                    
                            
                        </div>
                        <label class="cursor-pointer inline-block items-center flex">
                            <input id="images" type="file" accept=".jpeg, .jpg, .png, .gif" class="hidden form-control @error('images') is-invalid @enderror" name="images" value="{{ old('images') }}">
                            <p class="flex items-center justify-center text-5xl border-2 rounded-full w-11 h-11 pb-3 bg-yellow-400 border-yellow-400 text-white">+</p>
                        </label>
                        @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="text-left">  
                        <label class="pb-2">
                            <input type="checkbox" name="seller" class="rounded">
                            Je suis un vendeur
                        </label>
                        <br>
                        <label class="pb-2">
                            <input type="checkbox" name="customer" class="rounded"> 
                            Je suis un acheteur
                        </label>
                        <br>
                        <label class="pb-2">
                            <input type="checkbox" required>
                            Je déclare être en accord avec les Conditions Générales d'Utilisation de Kaven Harmony
                        </label>
                        
                    </div>
                    <div class="row mb-0 p-2 pb-4">
                        <div class="col-md-6 offset-md-4 flex justify-center">
                            <button type="submit" class="btn btn-primary bg-yellow-400 rounded-full border-2 border-yellow-400 shadow-inner p-1">
                                Créer son compte
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('footer')
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
     
$(document).ready(function (e) {

   $('#images').change(function(){
    let previewDiv = document.getElementById('image-preview');
    while (previewDiv.firstChild) {
        previewDiv.removeChild(previewDiv.firstChild);
    }
    let images = document.getElementById('images').files;
    for(let i =0; i < images.length; i++){
        let reader = new FileReader();
        reader.onload = (e) => { 
            $($.parseHTML('<img>')).attr('src', e.target.result).attr('class', 'rounded-full h-48 w-48 pr-2').appendTo("#image-preview");
        }
        reader.readAsDataURL(this.files[i]);         
    }  
   });  
});

</script>
</html>
