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
  console.log(maxPrice);
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
    div.setAttribute("name", data[i].name);
    divInstrument.appendChild(div);

    let divImage = document.createElement("div");
    divImage.classList.add("w-52", "h-52");
    div.appendChild(divImage);
    if(data[i].image[0] !== null){
      let image = document.createElement("img");
      image.classList.add("w-min-auto");
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
    pName.innerHTML = data[i].name;
    divAttribute.appendChild(pName);

    let pPrice = document.createElement("p");
    pPrice.innerHTML = data[i].price + "€";
    divAttribute.appendChild(pPrice);

    let divBasket = document.createElement("div");
    divBasket.classList.add("rounded-full", "text-purple-400", "bg-white", "flex", "justify-end", "items-center", "p-1");
    divGrid.appendChild(divBasket);

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
    divIconBasket.appendChild(basketIcon);

    let pathIcon = document.createElementNS("http://www.w3.org/2000/svg","path");
    pathIcon.setAttribute("stroke-linecap", "round");
    pathIcon.setAttribute("stroke-linejoin", "round");
    pathIcon.setAttribute("d", "M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z");
    basketIcon.appendChild(pathIcon);

    let divButton = document.createElement("div");
    divButton.classList.add("flex", "justify-center");
    div.appendChild(divButton);

    let aButton = document.createElement("a");
    let hrefButton =route('product', {id : data[i].id});
    aButton.href = hrefButton;
    divButton.appendChild(aButton);

    let button = document.createElement("button");
    button.classList.add("rounded-full", "bg-yellow-400", "p-1", "pl-2", "pr-2");
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