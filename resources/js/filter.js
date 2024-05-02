$( document ).ready(function() {
  //Déclaration des variables
  let allType = document.getElementsByName("Type");
  let allState = document.getElementsByName("State");
  let clearFilter = document.getElementById("clearFilter");
  let minPrice = document.getElementById("minPrice");
  let maxPrice = document.getElementById("maxPrice");
  let minInput = document.getElementById("minPriceInput");
  let maxInput = document.getElementById("maxPriceInput");
  
  //creation des EventListener
  minInput.addEventListener("change", inputMinTrigger);
  maxInput.addEventListener("change", inputMaxTrigger);

  minInput.addEventListener("change", getAllInstrumentWithPrice);
  maxInput.addEventListener("change", getAllInstrumentWithPrice);

  minPrice.addEventListener("input", mintrigger);
  maxPrice.addEventListener("input", maxtrigger);

  minPrice.addEventListener("change", getAllInstrumentWithPrice);
  maxPrice.addEventListener("change", getAllInstrumentWithPrice);
  for(let i = 0; i<allType.length; i++){
    allType[i].addEventListener("click", getAllInstrumentWithFilter);
  }
  for(let i = 0; i<allState.length; i++){
    allState[i].addEventListener("click", getAllInstrumentWithFilter);
  }
  clearFilter.addEventListener("click", deleteSelectFilter);
});

async function getAllInstrumentWithPrice(event){
  let allSelectedFilter = getSelectedFilter(event);
  if(event.target.tagName !== 'INPUT'){
    event.target.classList.add("selected");
  }
  let state = "";
  let type = "";
  let minPrice = document.getElementById("minPrice").value;
  let maxPrice = document.getElementById("maxPrice").value;
  for(let i = 0; i < allSelectedFilter.length; i++){
    if(allSelectedFilter[i].getAttribute("Name") == 'State'){
      state = allSelectedFilter[i].id;
    } 
    if(allSelectedFilter[i].getAttribute("Name") == 'Type'){
      type = allSelectedFilter[i].id;
    }
  }
  await callAjax(state,type,minPrice,maxPrice);
  
}

async function getAllInstrumentWithFilter(event){
  if(!event.target.classList.contains("selected")){
    let allSelectedFilter = getSelectedFilter(event);
    event.target.classList.add("selected");
    let state = "";
    let type = "";
    let minPrice = document.getElementById("minPrice").value;
    let maxPrice = document.getElementById("maxPrice").value;
    for(let i = 0; i < allSelectedFilter.length; i++){
      if(allSelectedFilter[i].getAttribute("Name") == 'State'){
        state = allSelectedFilter[i].id;
      } 
      if(allSelectedFilter[i].getAttribute("Name") == 'Type'){
        type = allSelectedFilter[i].id;
      }
    }
    await callAjax(state,type,minPrice,maxPrice);
  }else{
    event.target.classList.remove("selected");
    await callAjax(null,null,null,null);
  }
}

async function callAjax(state, type, minPrice, maxPrice){
  await jQuery.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/filterProduct',
      method : "GET",
      data: {state: state, type: type, minPrice:minPrice, maxPrice:maxPrice},
      success: function (data) {
        changeView(data);
      }
    });
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
    let href =route('product', {id : data[i].id});
    button.href = href;
    div.appendChild(button);
    
  }
}

async function deleteSelectFilter(){
  let allSelectedFilter = document.getElementsByClassName("selected");
  if(allSelectedFilter.length !== 0){
    for(let i = 0; i <= allSelectedFilter.length; i++){
      allSelectedFilter[0].classList.remove("selected"); 
    }
  }
  document.getElementById("minPrice").value = 0;
  document.getElementById("maxPrice").value = document.getElementById("maxPrice").max;
  document.getElementById("minPriceInput").value = 0;
  document.getElementById("maxPriceInput").value = document.getElementById("maxPrice").max;
  document.getElementById("minthumb").style = "left:0%";
  document.getElementById("maxthumb").style = "right:0%";
  document.getElementById("barthumb").style = "right:0%; left:0%";
  callAjax(null, null, null, null);
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
          allSelectedFilter[i].classList.remove("selected");
        } 
      }
    }
  }
  return allSelectedFilter;
}

function mintrigger() {
  let min = document.getElementById("minPrice").value;
  let max = document.getElementById("maxPrice").value;
  let minprice = document.getElementById("minPrice").min;
  let maxprice = document.getElementById("maxPrice").max;
  minprice = Math.max(minprice, maxprice - 1);      
  maxprice = Math.max(maxprice, minprice + 1);
  let minthumb = (100 * min)/maxprice;
  let maxthumb = (100- (100 * max)/minprice); 
  let minBar = document.getElementById("minthumb");
  let middleBar = document.getElementById("barthumb");
  minBar.style = "left: "+minthumb+"%";
  middleBar.style = "right:"+maxthumb+"%; left: "+minthumb+"%";
  document.getElementById("minPriceInput").value = min;
}

function maxtrigger() {
  let min = document.getElementById("minPrice").value;
  let max = document.getElementById("maxPrice").value;
  let minprice = document.getElementById("minPrice").min;
  let maxprice = document.getElementById("maxPrice").max;
  minprice = Math.max(minprice, maxprice - 1);      
  maxprice = Math.max(maxprice, minprice + 1);
  let minthumb = (100 * min)/maxprice; 
  let maxthumb = (100- (100 * max)/minprice); 
  let maxBar = document.getElementById("maxthumb");
  let middleBar = document.getElementById("barthumb");
  maxBar.style = "right: "+maxthumb+"%";
  middleBar.style = "right:"+maxthumb+"%; left: "+minthumb+"%"; 
  document.getElementById("maxPriceInput").value = max;
}

function inputMinTrigger() {
  let min = document.getElementById("minPriceInput").value;
  let max = document.getElementById("maxPrice").value;
  let minprice = document.getElementById("minPrice").min;
  let maxprice = document.getElementById("maxPrice").max;
  minprice = Math.max(minprice, maxprice - 1);      
  maxprice = Math.max(maxprice, minprice + 1);
  let minthumb = (100 * min)/maxprice;
  let maxthumb = (100- (100 * max)/minprice); 
  let minBar = document.getElementById("minthumb");
  let middleBar = document.getElementById("barthumb");
  minBar.style = "left: "+minthumb+"%";
  middleBar.style = "right:"+maxthumb+"%; left: "+minthumb+"%";
  document.getElementById("minPrice").value = min;
}

function inputMaxTrigger() {
  let min = document.getElementById("minPrice").value;
  let max = document.getElementById("maxPriceInput").value;
  let minprice = document.getElementById("minPrice").min;
  let maxprice = document.getElementById("maxPrice").max;
  minprice = Math.max(minprice, maxprice - 1);      
  maxprice = Math.max(maxprice, minprice + 1);
  let minthumb = (100 * min)/maxprice; 
  let maxthumb = (100- (100 * max)/minprice); 
  let maxBar = document.getElementById("maxthumb");
  let middleBar = document.getElementById("barthumb");
  maxBar.style = "right: "+maxthumb+"%";
  middleBar.style = "right:"+maxthumb+"%; left: "+minthumb+"%"; 
  document.getElementById("maxPrice").value = max;
}