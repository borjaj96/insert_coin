// script.js

// Escuchar el evento de cambio en el campo de CVV de la tarjeta
var cvvInput = document.querySelector('input[name="cvvTarjeta"]');
var valueCvvDiv = document.getElementById('value-cvv');

// Escuchar el evento de cambio en el campo de validez de la tarjeta
var validezInput = document.querySelector('input[name="validezTarjeta"]');
var valueValidezDiv = document.getElementById('value-validez');

if (cvvInput) {
    cvvInput.addEventListener('input', function() {
        valueCvvDiv.textContent = cvvInput.value;
    });
}

if (validezInput) {
    validezInput.addEventListener('input', function() {
        valueValidezDiv.textContent = validezInput.value;
    });
}


