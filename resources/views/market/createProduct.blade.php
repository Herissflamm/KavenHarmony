<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite(['resources/js/annonce.js'])
</head>
<body class = "">
@include('navbar')
<div class="pl-5">
  <a href="{{url('/search') }}"> 
    <p class="font-montserrat">
      < Retour 
    </p>
  </a> 
  <div class="font-montserrat font-bold text-xl pl-15 pb-10">Créer mon annonce</div>
</div>
<div class="text-lg text-center grid-cols-3 grid">
    <p class="bg-purple-400 rounded-tr-xl p-2 text-white" id="VenteButton" name="Vente">Vente</p>
    <p class="rounded-tr-xl p-2" id="LocationButton" name="Location">Location</p>
</div>
<div class="flex flex-col items-center row justify-center col-md-8 card bg-purple-50 w-full" id="Vente"> 
        <div class="card-body">
            <form method="POST" action="{{ url('/newProduct') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Nom de l'instrument: </label>

                    <div class="col-md-6 pl-7 pt-2">
                        <input id="name" type="text" class="pr-14 pl-2 rounded-full shadow-inner border-2 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Type d'instrument : </label>
                    <div class="col-md-6 pl-7 pt-2">
                        <select name="instrumentType" id="instrumentType" class="pr-11 pl-2 rounded-full shadow-inner border-2">
                            <option value="" selected disabled hidden class="">
                                Choisissez une catégorie  
                            </option>
                            @foreach ($allType as $type)
                                <option value="{{$type->type}}" class="text-black-50 not-italic">{{$type->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>

                <div class="row mb-3">
                    <label for="price" class="col-md-4 col-form-label text-md-end">Quel Prix ? : </label>

                    <div class="col-md-6 pl-7 pt-2 flex align-center">
                        <input id="price" type="text" class="pr-7 pl-2 rounded-r-lg rounded-full shadow-inner border-2 form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus> 
                        <p class="rounded-l-lg rounded-full border-2 bg-purple-400 border-purple-400 pr-2 pl-1 text-white">€</p>

                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descritpion</label>
                    <div class="pl-7 pt-2">
                        <textarea id="description" name="description" rows="4" class="pl-2 pt-1 rounded-xl shadow-inner border-2 block w-full text-sm resize-none" placeholder="Decrivez votre produit....."></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <fieldset>
                        <label for="state" class="col-md-4 col-form-label text-md-end">Quel Etat ? : </label>

                        <ul class="col-md-6 pt-2">
                            
                            @foreach ($allState as $state)
                            <li class="pl-7 pb-2">
                                <input name="state" type="radio" class="form-control cursor-pointer w-5 h-5 box-border appearance-none border-2 shadow-inner checked:bg-purple-400 bg-white rounded" id="{{ $state->state}}" required value="{{ $state->state}}">
                                <label class="pl-4" for="{{ $state->state}}">{{ $state->state}}</label>
                            </li>
                            @endforeach
                            
                        </ul>
                    </fieldset>
                </div>

                <div class="-ml-20 row mb-3">
                    <label for="images" class="col-md-4 col-form-label text-md-end">Importer les photos du produit : </label>

                    <div class="flex items-center pt-2">
                        <div id="image-preview" class="flex items-center">                    
                            
                        </div>
                        <label class="cursor-pointer inline-block">
                            <input id="images" type="file" accept=".jpeg, .jpg, .png, .gif" class="hidden form-control @error('images') is-invalid @enderror" name="images[]" value="{{ old('images') }}" required multiple>
                            <p class="flex items-center justify-center text-5xl border-2 rounded-full w-11 h-11 pb-3 bg-purple-400 border-purple-400 text-white">+</p>
                        </label>
                        @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <label class="pb-2">
                    <input type="checkbox" required>
                    Je déclare être en accord avec les Conditions Générales d'Utilisation de Kaven Harmony
                </label>

                <div class="row mb-0 pb-10">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary rounded-full bg-purple-400 text-white pl-5 pr-5 pt-1 pb-1">
                            Publier l'annonce
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="flex flex-col items-center row justify-center col-md-8 card bg-yellow-50 w-full hidden" id="Location"> 
        <div class="card-body">
            <form method="POST" action="{{ url('/newProduct') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Nom de l'instrument: </label>

                    <div class="col-md-6 pl-7 pt-2">
                        <input id="name" type="text" class="pr-14 pl-2 rounded-full shadow-inner border-2 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Type d'instrument : </label>
                    <div class="col-md-6 pl-7 pt-2">
                        <select name="instrumentType" id="instrumentType" class="text-gray-400 italic pr-11 pl-2 rounded-full shadow-inner border-2">
                            <option value="" selected disabled hidden class="">
                                Choisissez une catégorie  
                            </option>
                            @foreach ($allType as $type)
                                <option value="{{$type->type}}" class="text-black-50 not-italic">{{$type->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>

                <div class="row mb-3">
                    <label for="price" class="col-md-4 col-form-label text-md-end">Quel Prix ? A quelle fréquence ? </label>

                    <div class="col-md-6 pl-7 pt-2 flex align-center">
                        <input id="price" type="text" class="pr-7 pl-2 rounded-r-lg rounded-full shadow-inner border-2 form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus> 
                        <p class="rounded-l-lg rounded-full border-2 bg-yellow-400 border-yellow-400 pr-2 pl-1 text-white">€</p>

                        <select name="instrumentType" id="instrumentType" class="pr-11 pl-2 rounded-full shadow-inner border-2">
                            <option value="" selected disabled hidden class="">
                                Par mois, jour, heure ...
                            </option>
                            <option value="mois" class="text-black-50 not-italic">
                                Mois
                            </option>
                            <option value="jour" class="text-black-50 not-italic">
                                Jour
                            </option>
                            <option value="Heure" class="text-black-50 not-italic">
                                Heure
                            </option>                            
                        </select>

                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="date" class="col-md-4 col-form-label text-md-end">Durant quelle période ? </label>

                    <div class="col-md-6 pl-7 pt-2 flex align-center">
                        Du
                        <input id="datemin" type="date" class="pl-2 rounded-full shadow-inner border-2 form-control @error('datemin') is-invalid @enderror" name="datemin" value="{{ old('datemin') }}" required autocomplete="datemin" autofocus> 
                        Au
                        <input id="datemax" type="date" class="pl-2 pr-1 rounded-full shadow-inner border-2 form-control @error('datemax') is-invalid @enderror" name="datemax" value="{{ old('datemax') }}" required autocomplete="datemax" autofocus> 
                        @error('datemin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('datemax')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descritpion</label>
                    <div class="pl-7 pt-2">
                        <textarea id="description" name="description" rows="4" class="pl-2 pt-1 rounded-xl shadow-inner border-2 block w-full text-sm resize-none" placeholder="Decrivez votre produit....."></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <fieldset>
                        <label for="state" class="col-md-4 col-form-label text-md-end">Quel Etat ? : </label>

                        <ul class="col-md-6 pt-2">
                            
                            @foreach ($allState as $state)
                            <li class="pl-7 pb-2">
                                <input name="state" type="radio" class="form-control cursor-pointer w-5 h-5 box-border appearance-none border-2 shadow-inner checked:bg-yellow-400 bg-white rounded" id="{{ $state->state}}" required value="{{ $state->state}}">
                                <label class="pl-4" for="{{ $state->state}}">{{ $state->state}}</label>
                            </li>
                            @endforeach
                            
                        </ul>
                    </fieldset>
                </div>

                <div class="-ml-20 row mb-3">
                    <label for="images" class="col-md-4 col-form-label text-md-end">Importer les photos du produit : </label>

                    <div class="flex items-center pt-2">
                        <div id="image-preview" class="flex items-center">                    
                            
                        </div>
                        <label class="cursor-pointer inline-block">
                            <input id="images" type="file" accept=".jpeg, .jpg, .png, .gif" class="hidden form-control @error('images') is-invalid @enderror" name="images[]" value="{{ old('images') }}" required multiple>
                            <p class="flex items-center justify-center text-5xl border-2 rounded-full w-11 h-11 pb-3 bg-yellow-400 border-yellow-400 text-white">+</p>
                        </label>
                        @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0 pb-10">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary rounded-full bg-yellow-400 text-white pl-5 pr-5 pt-1 pb-1">
                            Publier l'annonce
                        </button>
                    </div>
                </div>
            </form>
        </div>
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
            $($.parseHTML('<img>')).attr('src', e.target.result).attr('class', 'w-24 h-24 pr-2').appendTo("#image-preview");
        }
        reader.readAsDataURL(this.files[i]);         
    }  
   });  
});

</script>
</html>
