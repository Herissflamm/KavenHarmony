$( document ).ready(function() {
  let allCross = document.getElementsByName("cross");
  for(let i = 0; i<allCross.length; i++){
    allCross[i].addEventListener("click", deleteFromBasket);
  }

  async function deleteFromBasket(event){
    let id = event.target.id;
    if(id === ""){
      id = event.target.parentNode.id;
    }
    await jQuery.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/deleteFromMyOrder',
      method : "DELETE",
      data: {id : id},
      success: function (data) {  
        changeView(data)
      }
    });
  }

  function changeView(data){
    let divInstrument = document.getElementById("allInstrument");
    let deletedElement = document.getElementById(data);
    divInstrument.removeChild(deletedElement.parentNode);
  }
});