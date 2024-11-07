function confirmDelete(event) {
    const response = confirm('¿Estás seguro de eliminar el articulo?');

    //Si es false cancela la ejecución
    if (!response) {
        event.preventDefault();
        return;
    }
}



$(document).ready(function() {
    // get error param
    function getUrlVars() {
      var vars = [],
        hash;
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
  

      const { errorCrearArticulo } = getUrlVars();
      console.log("Valor de errorLogin:", errorCrearArticulo);
      
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