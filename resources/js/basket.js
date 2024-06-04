$( document ).ready(function() {
  let allCross = document.getElementsByName("crossBasket");
  const id_order = document.getElementById("id_order").getAttribute("value");
  
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
      data: {
        id_instrument : id,
        id_order : id_order},
      success: function (data) {
        changeView(data);  
      }
    });
  }

  function changeView(data){
    let divInstrument = document.getElementById("allInstrument");
    let deletedElement = document.getElementById(data.id);
    divInstrument.removeChild(deletedElement.parentNode.parentNode.parentNode.parentNode);
    let price = document.getElementById('price_order').innerHTML;
    let price_val = price.substring(price.indexOf(":") + 1, price.lastIndexOf("€"));
    document.getElementById('price_order').innerHTML = 'Prix total : '+(Number(price_val)-data.sell.price)+ ' €';
    if(document.querySelectorAll('[name="instrument"]').length == 0){
     divInstrument.removeChild(document.getElementById('accept_button')); 
    }    
  }
});