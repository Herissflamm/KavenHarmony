$( document ).ready(function() {
  let vente = document.getElementById('VenteButton');
  let location = document.getElementById('LocationButton');

  vente.addEventListener("click", changeType);
  location.addEventListener("click", changeType);
  
  function changeType(event){
    let name = event.target.getAttribute('name');
    let location = document.getElementById("Location");
    let vente = document.getElementById("Vente");

    if(name === "Vente"){
      vente.classList.remove("hidden");
      event.target.classList.add("bg-purple-400","text-white");

      location.classList.add("hidden");
      document.getElementById("LocationButton").classList.remove("bg-yellow-400", "text-white");
    }
    if(name === "Location"){
      location.classList.remove("hidden");
      event.target.classList.add("bg-yellow-400","text-white");

      vente.classList.add("hidden");
      document.getElementById("VenteButton").classList.remove("bg-purple-400", "text-white");
    }
  }
});