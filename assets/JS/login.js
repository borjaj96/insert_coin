$(document).ready(function() {
  // get error param
  function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf("?") + 1).split("&");
      for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split("=");
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    }
  

    const { errorLogin, errorCrearCuenta, errorNuevaPassUser } = getUrlVars();
      
    if (errorLogin === undefined && errorCrearCuenta === undefined && errorNuevaPassUser === undefined) {
      return;
    }

    let message = 'No ha sido posible crear el usuario.';

    if (errorCrearCuenta === '0') {
      message = "Usuario creado con éxito, acuérdate de rellenar tus datos personales y de pago para poder hacer tus compras.";
    }

    if (errorLogin !== undefined) {
      message = "Error al iniciar sesión.";

      if (errorLogin === '0') {
        message = "Sesión iniciada con éxito.";
      }
    }

    if (errorNuevaPassUser !== undefined) {
      message = "No ha sido posible cambiar la contraseña.";

      if (errorNuevaPassUser === '0') {
        message = "Contraseña actualizada con éxito.";
      }
    }

    if (message) {
      alert(message);
    }

}); 