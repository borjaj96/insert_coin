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
  