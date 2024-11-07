function confirmDeleteUser(event) {
  const response = confirm('¿Estás seguro de eliminar el usuario seleccionado?');

  if (!response) {
      event.preventDefault();
      return;
  }
}


$(document).ready(function() {
  // get error param
  function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href .slice(window.location.href.indexOf("?") + 1).split("&");
      for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split("=");
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    }
  

    const { errorCrearAdmin, errorNuevaPassAdmin } = getUrlVars();
      
    if (errorCrearAdmin === undefined && errorNuevaPassAdmin === undefined) {
      return;
    }

    let message = 'No ha sido posible crear el usuario administrador.';

    if (errorCrearAdmin === '0') {
      message = "Usuario administrador creado con éxito.";
    }

    if (errorNuevaPassAdmin !== undefined) {
      message = "No ha sido posible cambiar la contraseña del usuario.";

      if (errorNuevaPassAdmin === '0') {
        message = "Contraseña de usuario actualizada con éxito.";
      }
    }
     

    if (message) {
      alert(message);
    }
});