//Se ejecuta una vez haya cargado la página
$(document).ready(function() {  //Obtener los parámetros de la URL
  
  function getUrlVars() { //Almacena los nombre de los parámetros
    
    var vars = [], hash;  //Obtiene la parte de la URL después de la ? y la divide por los &
    var hashes = window.location.href
      .slice(window.location.href.indexOf("?") + 1)
      .split("&");
    for (var i = 0; i < hashes.length; i++) {
      hash = hashes[i].split("=");
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
    }
  
      //Asigna el valor de los parametros de la url a errorCrearArticulo
      const { errorCrearArticulo } = getUrlVars();
    
      if (errorCrearArticulo === undefined) {
        return;
      }

      let message = 'No ha sido posible publicar el artículo.';

      if (errorCrearArticulo === '0') {
        message = "El artículo se ha publicado con éxito.";
      }

      if (message) {
        alert(message);
      }
});
  