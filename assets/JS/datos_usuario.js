//Se ejecuta una vez haya cargado la página
$(document).ready(function() {
  
  function getUrlVars() { //Obtener los parámetros de la URL
    
    var vars = [], hash;  //Almacena los nombre de los parámetros
    
    var hashes = window.location.href   
      .slice(window.location.href.indexOf("?") + 1)
      .split("&");  //Obtiene la parte de la URL después de la ? y la divide por los &
    for (var i = 0; i < hashes.length; i++) {
      hash = hashes[i].split("=");
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
    }
  
      //Asigna el valor de los parametros de la url a errorActualizarDatos
      const { errorActualizarDatos } = getUrlVars();
    
      if (errorActualizarDatos === undefined) {
        return;
      }

      let message = 'No ha sido posible actualizar los datos del usuario, compruebe que los datos introducidos sean correctos.';

      if (errorActualizarDatos === '0') {
        message = "Datos actualizados con éxito.";
      }

      if (message) {
        alert(message);
      }
});
  