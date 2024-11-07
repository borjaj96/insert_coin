//Se ejecuta una vez haya cargado la página
$(document).ready(function() {

    //Obtener los parámetros de la URL
    function getUrlVars()  {
        //Almacena los nombre de los parámetros
        var vars = [], hash;
        //Obtiene la parte de la URL después de la ? y la divide por los &
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++){
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    //Almacena el resultado de getUrlVars
    const { error } = getUrlVars();

    if (error) {
        alert('La validez de la tarjeta y/o el CVV no son válidos.');
    }

    $('form.form-pago').submit(function(event) {
        // Evitar que el formulario se envíe de forma predeterminada
        event.preventDefault(); 

        // Obtener los valores del formulario
        var validezTarjeta = $('#validezTarjeta').val();
        var cvvTarjeta = $('#cvvTarjeta').val();

        // Crear objeto de datos para enviar mediante AJAX
        var data = {
            validezTarjeta: validezTarjeta,
            cvvTarjeta: cvvTarjeta
        };

        // Realizar la solicitud AJAX
        $.ajax({
            url: './add', 
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                if (response.success) {
                    // La tarjeta es válida, continuar con el proceso de finalización de compra
                    alert('Enhorabuena! Has realizado una compra!');
                    // Aquí puedes realizar las acciones necesarias, como guardar el pedido, mostrar un mensaje de éxito, etc.
                } else {
                    // La tarjeta no es válida, mostrar el mensaje de alerta
                    alert(response.message);
                }
            },
            error: function(error) {
                console.log('Error: ', error);
                // Manejar errores de la solicitud AJAX si es necesario
                
                debugger;
            }
        });
    });
});
