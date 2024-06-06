$( document ).ready(function() {
  //Déclaration des variables
  let btn = document.getElementById("btn");
  let crossDate = document.getElementById("crossDate");
  let crossError = document.getElementById("crossError");

  if(btn != null){
    btn.addEventListener('click', showModalDate);
  }
  crossDate.addEventListener('click', showModalDate);
  if(crossError != null){
    crossError.addEventListener('click', showModalError);
  }
  
});

function showModalDate(){
  let modal = document.getElementById('modalDate');
  if(modal.classList.contains("hidden")){
    modal.classList.remove("hidden");
  }else{
    modal.classList.add("hidden");
  }
}

function showModalError(){
  let modal = document.getElementById('modalError');
  modal.classList.add("hidden");
}