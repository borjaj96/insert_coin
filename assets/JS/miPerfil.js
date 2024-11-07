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
  

    const { errorActualizarDatos } = getUrlVars();
      
    if (errorActualizarDatos === undefined) {
      return;
    }

    let message = 'No ha sido posible actualizar los datos  del usuario.';

    if (errorActualizarDatos === '0') {
      message = "Datos de usuario actualizados con éxito.";
    }

    if (message) {
      alert(message);
    }
});
  