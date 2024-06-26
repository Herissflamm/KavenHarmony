<!doctype html>
<html lang="fr">
<head>
    <title>Modifier un produit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class = "">
@include('navbar')
<div class="md:pl-5">
  <a href="{{url('/search') }}"> 
    <p class="font-montserrat">
      < Retour 
    </p>
  </a> 
  <div class="font-montserrat font-bold text-xl pl-15 pb-10">Modifier mon annonce</div>
</div>
<div class="text-lg text-center grid-cols-3 grid">
    @if($instrument->sell != null)
        <p class="bg-purple-400 rounded-tr-xl p-2 text-white" id="VenteButton" name="Vente">Vente</p>
    @else
        <p class="bg-yellow-400 rounded-tr-xl p-2 text-white" id="LocationButton" name="Vente">Location</p>
    @endif
</div>
@if($instrument->sell != null)
    <div class="flex flex-col items-center row justify-center col-md-8 card bg-purple-50 w-full" id="Vente">
@else
    <div class="flex flex-col items-center row justify-center col-md-8 card bg-yellow-50 w-full" id="Location">
@endif
    <div class="card-body">
        <form method="POST" action="{{ route('modifyProductPost') }}">
            @csrf
            <input class="hidden" value="{{$instrument->id}}" name="id">
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Nom de l'instrument: </label>

                <div class="col-md-6 pl-7 pt-2">
                    <input id="name" type="text" class="pr-14 pl-2 rounded-full shadow-inner border-2 form-control @error('name') is-invalid @enderror" name="name" value="{{ $instrument->name }}" required autofocus>

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
                        <option value="{{$instrument->type_instrument->type}}" selected hidden>
                            {{$instrument->type_instrument->type}}  
                        </option>
                        @foreach ($allType as $type)
                            <option value="{{$type->type}}" class="text-black-50 not-italic">{{$type->type}}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>

            <div class="row mb-3">
                <label for="price" class="col-md-4 col-form-label text-md-end">Quel Prix ? : </label>
                @if($instrument->sell != null)
                    <div class="col-md-6 pl-7 pt-2 flex align-center">
                        <input id="price" type="text" class="pr-7 pl-2 rounded-r-lg rounded-full shadow-inner border-2 form-control @error('price') is-invalid @enderror" name="price" value="{{ $instrument->sell->price  }}" required autocomplete="price" autofocus> 
                        <p class="rounded-l-lg rounded-full border-2 bg-purple-400 border-purple-400 pr-2 pl-1 text-white">€</p>

                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @elseif($instrument->rent != null)
                <div class="col-md-6 pl-7 pt-2 flex align-center">
                        <input id="price" type="text" class="pr-7 pl-2 rounded-r-lg rounded-full shadow-inner border-2 form-control @error('price') is-invalid @enderror" name="price" value="{{ $instrument->rent->price  }}" required autocomplete="price" autofocus> 
                        <p class="rounded-l-lg rounded-full border-2 bg-yellow-400 border-yellow-400 pr-2 pl-1 text-white">€/{{ $instrument->rent->frequency->frequency}}</p>

                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endif
            </div>
            @if($instrument->rent!=null)
                <div class="row mb-3">
                    <label for="date" class="col-md-4 col-form-label text-md-end">Date de fin maximum ? </label>

                    <div class="col-md-6 pl-7 pt-2 flex align-center">
                        
                        <input id="date_max" type="date" class="pl-2 pr-1 rounded-full shadow-inner border-2 form-control @error('date_max') is-invalid @enderror" name="date_max" value="{{ $instrument->rent->duration_max }}" required autocomplete="date_max" autofocus> 
                        @error('date_max')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Quel fréquence : </label>
                    <div class="col-md-6 pl-7 pt-2">
                        <select name="frequency" id="frequency" class="pr-11 pl-2 rounded-full shadow-inner border-2">
                            <option value="{{$instrument->rent->frequency->frequency}}" selected hidden class="">
                                {{$instrument->rent->frequency->frequency}} 
                            </option>
                            @foreach ($frequencies as $frequency)
                                <option value="{{$frequency->frequency}}" class="text-black-50 not-italic">{{$frequency->frequency}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            <div class="mb-3">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                <div class="pl-7 pt-2">
                    <textarea id="description" name="description" rows="4" class="pl-2 pt-1 rounded-xl shadow-inner border-2 block w-full text-sm resize-none" placeholder="Decrivez votre produit.....">{{$instrument->description}}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <fieldset>
                    <label for="state" class="col-md-4 col-form-label text-md-end">Quel Etat ? : </label>

                    <ul class="col-md-6 pt-2">
                        @if($instrument->sell != null)
                            @foreach ($allState as $state)
                            <li class="pl-7 pb-2">
                                @if($state->state == $instrument->state->state)
                                <input name="state" type="radio" class="form-control cursor-pointer w-5 h-5 box-border appearance-none border-2 shadow-inner checked:bg-purple-400 bg-white rounded" id="{{ $state->state}}" required value="{{ $state->state}}" checked>
                                <label class="pl-4" for="{{ $state->state}}">{{ $state->state}}</label>
                                @else
                                <input name="state" type="radio" class="form-control cursor-pointer w-5 h-5 box-border appearance-none border-2 shadow-inner checked:bg-purple-400 bg-white rounded" id="{{ $state->state}}" required value="{{ $state->state}}">
                                <label class="pl-4" for="{{ $state->state}}">{{ $state->state}}</label>
                                @endif
                            </li>
                            @endforeach
                        @elseif($instrument->rent != null)
                            @foreach ($allState as $state)
                                <li class="pl-7 pb-2">
                                    @if($state->state == $instrument->state->state)
                                    <input name="state" type="radio" class="form-control cursor-pointer w-5 h-5 box-border appearance-none border-2 shadow-inner checked:bg-yellow-400 bg-white rounded" id="{{ $state->state}}" required value="{{ $state->state}}" checked>
                                    <label class="pl-4" for="{{ $state->state}}">{{ $state->state}}</label>
                                    @else
                                    <input name="state" type="radio" class="form-control cursor-pointer w-5 h-5 box-border appearance-none border-2 shadow-inner checked:bg-yellow-400 bg-white rounded" id="{{ $state->state}}" required value="{{ $state->state}}">
                                    <label class="pl-4" for="{{ $state->state}}">{{ $state->state}}</label>
                                    @endif
                                </li>
                            @endforeach 
                        @endif 
                    </ul>
                </fieldset>
            </div>
            
            <label class="pb-2">
                <input type="checkbox" required>
                Je déclare être en accord avec les Conditions Générales d'Utilisation de Kaven Harmony
            </label>

            <div class="row mb-0 pb-10 pt-2">
                <div class="col-md-6 offset-md-4 items-center flex justify-center">
                    <button type="submit" class="btn btn-primary rounded-full bg-purple-400 text-white pl-5 pr-5 pt-1 pb-1">
                        Modifier l'annonce
                    </button>
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
            $($.parseHTML('<img>')).attr('src', e.target.result).attr('class', 'w-36 h-36 pr-2').appendTo("#image-preview");
        }
        reader.readAsDataURL(this.files[i]);         
    }  
   });  
});

</script>
</html>
