$(document).ready(function() {
  // get error param
  function getUrlVars()  {
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++){
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
  }

  function handleClick() {
      const { errorLogout } = getUrlVars();
      
      if (errorLogout) {
        alert("Error al cerrar sesión.");
      } else {
        alert("Sesión cerrada con éxito.");
      }
    }
      
    $("#cerrarSesion").on("click", handleClick);
})