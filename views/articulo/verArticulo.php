<?php if(isset($art)):?>
    <h1 class="text-center p-md-5 p-sm-0 pb-md-5"><?=$art->titulo?></h1>
    
    <div class="imagen-principal position-relative mb-5">
        <img src="<?=base_url?>assets/uploads/images/<?=$art->foto?>" alt="">
    </div>
    
    <p id="texto-bbdd"><?=$art->descripcion?></p>

    <!-- Formateo del texto-->
    <script>
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
    </script>

<?php else: ?>
    <h1 class="">La categoría no existe</h1>
<?php endif; ?>