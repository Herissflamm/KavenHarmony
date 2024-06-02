$( document ).ready(function() {
  //Déclaration des variables
  let sell = document.getElementById("sell");
  let rent = document.getElementById("rent");
  let allType = document.getElementsByName("Type");
  let allState = document.getElementsByName("State");
  let clearFilter = document.getElementById("clearFilter");
  let minPrice = document.getElementById("minPrice");
  let maxPrice = document.getElementById("maxPrice");
  let minInput = document.getElementById("minPriceInput");
  let maxInput = document.getElementById("maxPriceInput");
  let corde = document.getElementById("Cordes");
  let vent = document.getElementById("Vent");
  let percussions = document.getElementById("Percussions");
  
  //creation des EventListener
  minInput.addEventListener("change", inputMinTrigger);
  maxInput.addEventListener("change", inputMaxTrigger);

  minInput.addEventListener("change", getAllInstrumentWithPrice);
  maxInput.addEventListener("change", getAllInstrumentWithPrice);

  minPrice.addEventListener("input", mintrigger);
  maxPrice.addEventListener("input", maxtrigger);

  sell.addEventListener("click", getAllInstrumentWithFilter);
  rent.addEventListener("click", getAllInstrumentWithFilter);

  minPrice.addEventListener("change", getAllInstrumentWithPrice);
  maxPrice.addEventListener("change", getAllInstrumentWithPrice);
  for(let i = 0; i<allType.length; i++){
    allType[i].addEventListener("click", getAllInstrumentWithFilter);
  }
  for(let i = 0; i<allState.length; i++){
    allState[i].addEventListener("click", getAllInstrumentWithFilter);
  }
  clearFilter.addEventListener("click", deleteSelectFilter);

  corde.addEventListener("click", openCategory);
  vent.addEventListener("click", openCategory);
  percussions.addEventListener("click", openCategory);
});

function openCategory(event){
  let childs = event.target.children;
  for(let i = 0; i<childs.length; i++ ){
    if(childs[i].classList.contains('hidden')){
      childs[i].classList.remove('hidden');
    }else{
      childs[i].classList.add('hidden');
    }
    
  }
}

async function getAllInstrumentWithPrice(event){
  let allSelectedFilter = getSelectedFilter(event);
  if(event.target.tagName === 'INPUT'){
    event.target.classList.remove("selected");
  }
  let state = "";
  let type = "";
  let minPrice = document.getElementById("minPrice").value;
  let maxPrice = document.getElementById("maxPrice").value;
  let sell = document.getElementById("sell");
  let rent = document.getElementById("rent");
  let rentSearch = false;
  let sellSearch = false;
  if(rent.classList.contains("selected")){
    rentSearch = true;
  }
  if(sell.classList.contains("selected")){
    sellSearch = true;
  }
  for(let i = 0; i < allSelectedFilter.length; i++){
    if(allSelectedFilter[i].getAttribute("Name") == 'State'){
      state = allSelectedFilter[i].id;

    } 
    if(allSelectedFilter[i].getAttribute("Name") == 'Type'){
      type = allSelectedFilter[i].id;
    }
  }
  await callAjax(state,type,minPrice,maxPrice, rentSearch, sellSearch);
  
}

async function getAllInstrumentWithFilter(event){
  let allSelectedFilter = getSelectedFilter(event);
  let state = null;
  let type = null;
  let minPrice = document.getElementById("minPrice").value;
  let maxPrice = document.getElementById("maxPrice").value;
  let sell = document.getElementById("sell");
  let rent = document.getElementById("rent");
  let rentSearch = false;
  let sellSearch = false;
  if(rent.classList.contains("selected")){
    rentSearch = true;
  }
  if(sell.classList.contains("selected")){
    sellSearch = true;
  }
  for(let i = 0; i < allSelectedFilter.length; i++){
    if(allSelectedFilter[i].getAttribute("Name") == 'State'){
      state = allSelectedFilter[i].id;
    } 
    if(allSelectedFilter[i].getAttribute("Name") == 'Type'){
      type = allSelectedFilter[i].id;
    }
  }
  await callAjax(state,type,minPrice,maxPrice, rentSearch, sellSearch);
}

async function callAjax(state, type, minPrice, maxPrice, rentSearch, sellSearch){
  await jQuery.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/filterProduct',
      method : "GET",
      data: {state: state, type: type, minPrice:minPrice, maxPrice:maxPrice, rentSearch:rentSearch, sellSearch:sellSearch},
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
    div.setAttribute("name", data[i].name);
    divInstrument.appendChild(div);

    let divImage = document.createElement("div");
    divImage.classList.add("w-52", "h-52");
    div.appendChild(divImage);
    if(data[i].image[0] !== null){
      let image = document.createElement("img");
      image.setAttribute("alt", "Photo du produit")
      image.classList.add("object-fill", "w-52", "h-52");
      image.src = "/images/"+data[i].image[0].path;
      divImage.appendChild(image);
    }

    let divGrid = document.createElement("div");
    divGrid.classList.add("grid", "grid-cols-2", "pb-2");
    div.appendChild(divGrid);

    let divAttribute = document.createElement("div");
    divAttribute.classList.add("text-left");
    divGrid.appendChild(divAttribute);

    let pName = document.createElement("p");
    pName.classList.add("font-montserrat", "text-lg");
    pName.innerHTML = data[i].name;
    divAttribute.appendChild(pName);

    let pPrice = document.createElement("p");
    if(data[i].sell != undefined){
      pPrice.innerHTML = data[i].sell.price + " €";
    }else{
      pPrice.innerHTML = data[i].rent.price + " €/mois";
    }
    pPrice.classList.add("font-serif");
    divAttribute.appendChild(pPrice);

    let divBasket = document.createElement("div");
    divBasket.classList.add("rounded-full", "text-purple-400", "bg-white", "flex", "justify-end", "items-center", "p-1");
    divGrid.appendChild(divBasket);

    let customer = document.getElementById('customer');
    if(customer != undefined){
      let basket = document.createElement("a");
      let href =route('addToBasket', {id : data[i].id});
      basket.href = href;
      divBasket.appendChild(basket);
      
      let divIconBasket = document.createElement("div");
      divIconBasket.classList.add("relative");
      basket.appendChild(divIconBasket);

      let basketIcon = document.createElementNS("http://www.w3.org/2000/svg", "svg");
      basketIcon.classList.add("file:", "h-6", "w-6");
      basketIcon.setAttribute("fill", "none");
      basketIcon.setAttribute("viewBox", "0 0 24 24");
      basketIcon.setAttribute("stroke-width", "1.5");
      basketIcon.setAttribute("stroke", "currentColor");
      basketIcon.classList.add("file:", "h-6", "w-6");
      divIconBasket.appendChild(basketIcon);
      let pathIcon = document.createElementNS("http://www.w3.org/2000/svg","path");
      pathIcon.setAttribute("stroke-linecap", "round");
      pathIcon.setAttribute("stroke-linejoin", "round");
      pathIcon.setAttribute("d", "M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z");
      basketIcon.appendChild(pathIcon);
    }

    let divButton = document.createElement("div");
    divButton.classList.add("flex", "justify-center");
    div.appendChild(divButton);

    let aButton = document.createElement("a");
    let hrefButton =route('product', {id : data[i].id});
    aButton.href = hrefButton;
    divButton.appendChild(aButton);

    let button = document.createElement("button");
    button.classList.add("rounded-full", "bg-yellow-400", "p-1", "pl-2", "pr-2","text-white","mb-1");
    button.innerHTML = "Voir l'instrument";
    aButton.appendChild(button);

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
  callAjax(null, null, null, null, true, true);
}

function getSelectedFilter(event){
  let name = event.target.getAttribute("Name");
  let allSelectedFilter = document.getElementsByClassName("selected");
  if(allSelectedFilter != null){
    if(name === "State"){
      for(let i = 0; i < allSelectedFilter.length; i++){
        if(allSelectedFilter[i].getAttribute("Name") === 'State' && event.target.id !== allSelectedFilter[i].id){
          allSelectedFilter[i].classList.remove("selected");
        } 
      }
    }else if(name === "Type"){
      for(let i = 0; i < allSelectedFilter.length; i++){
        if(allSelectedFilter[i].getAttribute("Name") === 'Type' && event.target.id !== allSelectedFilter[i].id){
          allSelectedFilter[i].classList.remove("selected");
        } 
      }
    }
  }
  if(!event.target.classList.contains("selected")){
    event.target.classList.add("selected");
  }else{
    event.target.classList.remove("selected");
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