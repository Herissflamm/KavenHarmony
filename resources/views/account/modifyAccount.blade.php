<!doctype html>
<html lang="fr">
<head>
    <title>Modifier mon compte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50 ">
@include('navbar')
<div class="flex flex-col items-center pt-2 pb-2">
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
        <h1 class="font-montserrat font-bold text-xl">Modifier mon compte</h1>
    </div>
    <div class="justify-center items-center">
        <form method="POST" action="{{ route('modifyAccountPost') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col items-center">
                <div class="row mb-3">
                    <label for="first_name" class="col-md-4 col-form-label text-md-end">Nom :</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required>

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
                        <input id="last_name" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="given-name">

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
                        <input id="username" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required >

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
                        <input id="phone" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="tel">

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
                        <input id="email" type="email" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required placeholder="jeandupont@gmail.com" autocomplete="email">

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
                        <input id="city" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->address->city }}" required autocomplete="city">

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
                        <input id="post_code" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('post_code') is-invalid @enderror" name="post_code" value="{{ $user->address->post_code }}" required autocomplete="postal-code">

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
                        <input id="street_number" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('street_number') is-invalid @enderror" name="street_number" value="{{ $user->address->street_number }}" required autocomplete="street-number">

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
                        <input id="street_name" type="text" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('street_name') is-invalid @enderror" name="street_name" value="{{ $user->address->street_name }}" required>

                        @error('street_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="current_password" class="col-md-4 col-form-label text-md-end">Mot de passe actuel </label>

                    <div class="col-md-6">
                        <input id="current_password" type="password" class="pr-1 pl-2 rounded-full shadow-inner border-2 form-control @error('current_password') is-invalid @enderror" name="current_password" required>

                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Nouveau mot de passe </label>

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
                            @if ($user->image != null)             
                                <img src="/images/{{$user->image->path}}" class="rounded-full h-48 w-48" alt="Photo de profil">
                            @endif
                        </div>
                        <label class="pl-5 cursor-pointer inline-block items-center flex">
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
                    <div class="row mb-0 p-2 pb-4">
                        <div class="col-md-6 offset-md-4 flex justify-center">
                            <button type="submit" class="btn btn-primary bg-yellow-400 rounded-full border-2 border-yellow-400 shadow-inner p-1">
                                Modifier son compte
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" nonce="{{ Vite::cspNonce() }}"></script>

<script type="text/javascript" nonce="{{ Vite::cspNonce() }}">
     
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
