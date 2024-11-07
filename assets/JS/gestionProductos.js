function confirmDeleteProducto(event) {
    const response = confirm('¿Estás seguro de eliminar el producto?');

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
  

    const { errorCrearProducto } = getUrlVars();
    console.log("Valor de errorLogin:", errorCrearProducto);
      
    if (errorCrearProducto === undefined) {
      return;
    }

    let message = 'No ha sido posible subir el producto al mercadillo.';

    if (errorCrearProducto === '0') {
      message = "El producto se ha subido al mercadillo con éxito.";
    }

    if (message) {
      alert(message);
    }

});