$(document).ready(function() {
  // get error param
  function getUrlVars() {
    var vars = [], hash;
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
  

  const { errorNuevaPassUser } = getUrlVars();
    
  if (errorNuevaPassUser === undefined) {
    return;
  }

  let message = 'No ha sido posible cambiar la contraseña.';

  if (errorNuevaPassUser === '0') {
    message = "Contraseña actualizada con éxito.";
  }

  if (message) {
    alert(message);
  }
});  