<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="pl-20">
  <a href="{{url('/search') }}"> 
    <p class="font-montserrat">
      < Retour 
    </p>
  </a> 
</div>
<h1 class="font-montserrat font-bold">Créer mon annonce - Vente</h1>
<div class="flex flex-col items-center row justify-center col-md-8 card bg-purple-200 "> 
    <div class="card-body ">
        <form method="POST" action="{{ url('/newProduct') }}" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom de l instrument') }} : </label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <select name="instrumentType" id="instrumentType">
                    <option value="">
                        {{ __('Type d instrument') }}
                    </option>
                    @foreach ($allType as $type)
                        <option value="{{$type->type}}">{{$type->type}}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-3">
                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Quel Prix ?') }} : </label>

                <div class="col-md-6">
                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <fieldset>
                    <label for="state" class="col-md-4 col-form-label text-md-end">{{ __('Quel Etat ?') }} : </label>

                    <div class="col-md-6">
                        
                        @foreach ($allState as $state)
                            <input name="state" type="radio" class="form-control" id="{{ $state->state}}" required value="{{ $state->state}}">
                            <label for="{{ $state->state}}">{{ $state->state}}</label>
                        @endforeach
                        
                    </div>
                </fieldset>
            </div>

            <div class="mb-3">
                <label for="description" class="block mb-2 te   xt-sm font-medium text-gray-900 dark:text-white">Descritpion</label>
                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm" placeholder="Decrivez votre article ici....."></textarea>
            </div>

            <div class="row mb-3">
                <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('Ajouter une image') }} : </label>

                <div class="col-md-6">
                    <input id="images" type="file" accept=".jpeg, .jpg, .png, .gif" class="form-control @error('images') is-invalid @enderror" name="images[]" value="{{ old('images') }}" required multiple>

                    @error('images')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 ">
                <div id="image-preview" class="grid grid-cols-4 gap-4">                    
                    <img id="first-image-preview" src="/logo/kazoo.png"
                            alt="preview image" class="w-24">
                    </img>
                </div>
            </div>
            

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Ajouter en vente') }}
                    </button>
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
            $($.parseHTML('<img>')).attr('src', e.target.result).attr('class', 'w-24').appendTo("#image-preview");
        }
        reader.readAsDataURL(this.files[i]);         
    }  
   });  
});

</script>
</html>
