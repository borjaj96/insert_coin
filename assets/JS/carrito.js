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
    
        //Asigna el valor de los parametros de la url a errorInsertarCarrito
        const { errorInsertarCarrito } = getUrlVars();
      
        if (errorInsertarCarrito === undefined) {
          return;
        }
  
        let message = '¡OJO! el producto ya está en el carrito.';
  
        if (errorInsertarCarrito === '0') {
          message = "Producto agregado al carrito.";
        }
  
        if (message) {
          alert(message);
        }
  });
    


  