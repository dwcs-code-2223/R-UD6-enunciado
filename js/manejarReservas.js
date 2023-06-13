



function reservar(){
   
    let reserva_url = "?controller=Reserva&action=save";

  
    

//TO DO: completa la función






    fetch(request)
            .then((response) => {
                if (response.status === 200) {
                    return response.text();
                } else if (response.status === 400) {
                    console.log('error 400');
                    return false;
                } else {
                    console.log("Something went wrong on API server!");
                    return false;
                }

            })
            .then((response) => {
                if ((response === false)){
                    showMsg("Se ha producido un error", true, ERROR_MSG_TYPE);
                }
               else
                    showMsg('Su reserva se ha creado con éxito', true,SUCCESS_MSG_TYPE);
                    document.getElementsByTagName("html")[0].innerHTML = response;
                }
               

            
            )
            .catch((error) => {
                console.error('Ha ocurrido un error en login' + error);
                showMsg('La reserva no se ha podido realizar', true, ERROR_MSG_TYPE);
            });
}




