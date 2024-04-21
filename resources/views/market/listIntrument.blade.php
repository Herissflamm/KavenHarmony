<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite('resources/css/app.css')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript">
    $( document ).ready(function() {
      let allType = document.getElementsByName("Type");
      let allState = document.getElementsByName("State");
      let clearFilter = document.getElementById("clearFilter");
      for(let i = 0; i<allType.length; i++){
        allType[i].addEventListener("click", getAllInstrumentWithFilter);
      }
      for(let i = 0; i<allState.length; i++){
        allState[i].addEventListener("click", getAllInstrumentWithFilter);
      }
      clearFilter.addEventListener("click", deleteSelectFilter);
    });
    async function getAllInstrumentWithFilter(event){
      if(!event.target.classList.contains("selected")){
        let allSelectedFilter = getSelectedFilter(event);
        event.target.classList.add("selected");
        let state = "";
        let type = "";
        for(let i = 0; i < allSelectedFilter.length; i++){
          if(allSelectedFilter[i].getAttribute("Name") == 'State'){
            state = allSelectedFilter[i].id;
          } 
          if(allSelectedFilter[i].getAttribute("Name") == 'Type'){
            type = allSelectedFilter[i].id;
          }
        }
        await jQuery.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/filterProduct',
          method : "POST",
          data: {state: state, type: type},
          success: function (data) {
            changeView(data);
          }
        });
      }else{
        event.target.classList.remove("selected");
      }
    }

    function changeView(data){
      let divInstrument = document.getElementById("allInstrument");
      while (divInstrument.firstChild) {
        divInstrument.removeChild(divInstrument.lastChild);
      }
      for(let i = 0; i<data.length; i++){
        let div = document.createElement("div");
        div.classList.add("rounded", "overflow-hidden", "shadow-lg", "w-60");
        divInstrument.appendChild(div);

        let pType = document.createElement("p");
        pType.classList.add("text-center");
        pType.innerHTML = data[i].type;
        div.appendChild(pType);

        let pState = document.createElement("p");
        pState.classList.add("text-center");
        pState.innerHTML = data[i].state;
        div.appendChild(pState);
        if(data[i].image !== null){
          let image = document.createElement("img");
          image.classList.add("w-24");
          image.src = "/images/"+data[i].image;
          div.appendChild(image);
        }

        let pPrice = document.createElement("p");
        pPrice.classList.add("text-center");
        pPrice.innerHTML = data[i].price + "€";
        div.appendChild(pPrice);

        let button = document.createElement("a");
        button.classList.add("block", "px-2", "py-3", "text-center", "rounded-lg", "dark:bg-red-50", "m-auto");
        button.innerHTML = "Voir l'instrument";
        let href ="{{ route('product', ['id' => 'idVal']) }}"
        href = href.replace('idVal',data[i].id);
        button.href = href;
        div.appendChild(button);
        
      }
    }

    async function deleteSelectFilter(){
      let allSelectedFilter = document.getElementsByClassName("selected");
      console.log(allSelectedFilter[1]);
      for(let i = 0; i <= allSelectedFilter.length; i++){
        allSelectedFilter[0].classList.remove("selected"); 
      }
      await jQuery.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/filterProduct',
          method : "POST",
          data: {state: null, type: null},
          success: function (data) {
            changeView(data);
          }
        });
    }
    
    function getSelectedFilter(event){
      let name = event.target.getAttribute("Name");
      let allSelectedFilter = document.getElementsByClassName("selected");
      if(allSelectedFilter != null){
        if(name === "State"){
          for(let i = 0; i < allSelectedFilter.length; i++){
            if(allSelectedFilter[i].getAttribute("Name") == 'State'){
              allSelectedFilter[i].classList.remove("selected");
            } 
          }
        }else if(name === "Type"){
          for(let i = 0; i < allSelectedFilter.length; i++){
            if(allSelectedFilter[i].getAttribute("Name") == 'Type'){
              console.log(allSelectedFilter);
              allSelectedFilter[i].classList.remove("selected");
              console.log(allSelectedFilter);
            } 
          }
        }
      }
      return allSelectedFilter;
    }
  </script>
</head>
<body class = "dark:bg-white-50">
@include('navbar')
<div class="flex">
  <div class="relative flex h-auto w-full max-w-48 flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
    <div class="mt-4 border-t border-gray-200">
      <h3 class="bg-red-50 text-center text-xl">Filtre</h3>
      <ul role="list" class="px-2 py-3 font-medium text-gray-900">
        <li>
          <a href="#" class="block px-2 py-3" id="clearFilter">Retirer les filtres selectionné</a>
        </li>
        <li>
          <a href="#" class="block px-2 py-3">Prix</a>
        </li>
        <li>
          <ul role="list" class="px-2 py-3">Type
          @foreach ($allType as $type)
            <li class="font-normal" id="{{ $type->getType() }}" name="Type">
              {{$type->getType()}}
            </li>
          @endforeach
          </ul>
        </li>
        <li>
          <ul role="list" class="px-2 py-3">Etat
          @foreach ($allState as $state)
            <li class="font-normal" id="{{ $state->getState() }}" name="State">
              {{$state->getState()}}
            </li>
          @endforeach
          </ul>
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
    <div class="grid grid-cols-4 gap-2 object-center" id="allInstrument">
      @foreach ($instruments as $instrument)
        <div class="rounded overflow-hidden shadow-lg w-60" name="{{ $instrument->getName() }}">
              <p class="text-center">{{ $instrument->getType()->getType() }}</p>
              <p class="text-center">{{ $instrument->getState()->getState() }}</p>
              @if($instrument->getImage()!=null)
                <img src="/images/{{$instrument->getImage()[0]->getPath()}}" class="w-24"/>
              @endif
              <p class="text-center">{{ $instrument->getSell()->getPrice()}} €</p>
              <a href="{{ route('product', ['id' => $instrument->getId()]) }}" class="block px-2 py-3 text-center rounded-lg dark:bg-red-50 m-auto">Voir l'instrument</a>
        </div>
      @endforeach
    </div>
  </div>
</div>
@include('footer')
</body>
</html>
