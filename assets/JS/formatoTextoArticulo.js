document.addEventListener('DOMContentLoaded', function() {
  const textoBBDD = document.getElementById('texto-bbdd');
  const texto = textoBBDD.innerHTML;
  const textoFormateado = agregarSaltosLinea(texto);
  textoBBDD.innerHTML = textoFormateado;

  function agregarSaltosLinea(texto) {
    let contador = 0;
    let textoFormateado = '';
  
    for (let i = 0; i < texto.length; i++) {
      if (texto[i] === '.') {
        contador++;
        if (contador % 3 === 0) {
          textoFormateado += '.' + '<br><br>';
        } else {
          textoFormateado += '.';
        }
      } else {
        textoFormateado += texto[i];
      }
    }
  
    return textoFormateado;
  }
});