// Ejecuta el código una vez se ha cargado el HTML
document.addEventListener("DOMContentLoaded", function () {
    // Recoge todos los form del HTML
    var formularios = document.getElementsByTagName("form");

    // Itera sobre todos los formularios recogidos antes
    for (var i = 0; i < formularios.length; i++) {
        var formulario = formularios[i];

        // Agrega un evento input a cada formulario, permite validar los campos del formulario mientras se escribe
        formulario.addEventListener("input", function (event) {
            validarCampo(event.target);
        });

        // Agrega un evento submit a cada formulario, para interceptar el envío del formulario y hacer las validaciones antes de que el formulario se envíe
        formulario.addEventListener("submit", function (event) {
            event.preventDefault();

            if (validarFormulario(this)) {
                this.submit();
            }
        });
    }
    
    //Se recogen todos los campos del formulario mediante formulario.getElementsByClassName("form-control") y se itera 
    //sobre ellos para aplicar las validaciones
    function validarFormulario(formulario) {
        var campos = formulario.getElementsByClassName("form-control");

        var isValid = true;

        for (var i = 0; i < campos.length; i++) {
            var campo = campos[i];
            var campoId = campo.id;

            /*FORMULARIO LOGIN*/
            if (formulario.id === "formularioLogin") {
                if (campoId === "emailLogin") {
                    if (!validarEmail(campo.value)) {
                        mostrarError(campo, "El email ingresado no es válido.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "passLogin") {
                    if (!validarPassword(campo.value)) {
                        mostrarError(
                            campo,
                            "La contraseña debe tener una longitud entre 5 y 9 caracteres, incluir al menos un número y una mayúscula."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }
            }

            /*FORMULARIO REGISTRO*/
            if (formulario.id === "formularioRegistro") {
                if (campoId === "nombreRegistro") {
                    if (!validarNombre(campo.value)) {
                        mostrarError(
                            campo,
                            "El nombre debe ser una palabra que empiece con mayúscula y sin números."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "apellidosRegistro") {
                    if (!validarApellidos(campo.value)) {
                        mostrarError(
                            campo,
                            "Los apellidos deben ser mínimo dos palabras que empiecen con mayúscula y sin números."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "emailRegistro") {
                    if (!validarEmail(campo.value)) {
                        mostrarError(campo, "El email ingresado no es válido.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "passRegistro") {
                    if (!validarPassword(campo.value)) {
                        mostrarError(
                            campo,
                            "La contraseña debe tener una longitud entre 5 y 9 caracteres, incluir al menos un número y una mayúscula."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }
            }

            /*FORMULARIO CREAR ADMIN*/
            if (formulario.id === "formularioCrearAdmin") {
                if (campoId === "nombreAdmin") {
                    if (!validarNombre(campo.value)) {
                        mostrarError(
                            campo,
                            "El nombre debe ser una palabra que empiece con mayúscula y sin números."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "apellidosAdmin") {
                    if (!validarApellidos(campo.value)) {
                        mostrarError(
                            campo,
                            "Los apellidos deben ser mínimo dos palabras que empiecen con mayúscula y sin números."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "emailAdmin") {
                    if (!validarEmail(campo.value)) {
                        mostrarError(campo, "El email ingresado no es válido.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "passAdmin") {
                    if (!validarPassword(campo.value)) {
                        mostrarError(
                            campo,
                            "La contraseña debe tener una longitud entre 5 y 9 caracteres, incluir al menos un número y una mayúscula."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }
            }

            /*FORMULARIO ARTICULO*/
            if (formulario.id === "formularioArticulo") {
                if (campoId === "tituloArticulo") {
                    if (!validarTituloArticulo(campo.value)) {
                        mostrarError(
                            campo,
                            "El título debe ser mínimo una palabra que empiece con mayúscula, máximo 70 caracteres, puede llevar números y espacios."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "descripcionArticulo") {
                    if (!validarDescripcionArticulo(campo.value)) {
                        mostrarError(
                            campo,
                            "No se permiten espacios al principio ni al final, debe ser texto plano sin caracteres especiales, salvo interrogaciones, exclamaciones, puntos y comas."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "fotoArticulo") {
                    if (!validarFoto(campo.value)) {
                        mostrarError(campo, "La imagen debe de estar en formato jpeg, jpg o png");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }
            }

            /*FORMULARIO PRODUCTO*/
            if (formulario.id === "formularioProducto") {
                if (campoId === "nombreProducto") {
                    if (!validarNombreProducto(campo.value)) {
                        mostrarError(
                            campo,
                            "El nombre debe ser mínimo una palabra que empiece con mayúscula, máximo 70 caracteres, puede llevar números y espacios."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "descripcionProducto") {
                    if (!validarDescripcionProducto(campo.value)) {
                        mostrarError(
                            campo,
                            "No se permiten espacios al principio ni al final, debe ser texto plano sin caracteres especiales, salvo interrogaciones, exclamaciones, puntos y comas."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "precioProducto") {
                    if (!validarPrecioProducto(campo.value)) {
                        mostrarError(
                            campo,
                            "El precio debe ser un número."
                        );
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "fotoProducto") {
                    if (!validarFoto(campo.value)) {
                        mostrarError(campo, "La imagen debe de estar en formato jpeg, jpg o png");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }
            }

            /*FORMULARIO DATOS USER*/
            if (formulario.id === "formularioDatosUser") {
                if (campoId === "dniUser") {
                    if (!validarDni(campo.value)) {
                        mostrarError(campo, "El DNI ingresado no es válido.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "telefonoUser") {
                    if (!validarTelefono(campo.value)) {
                        mostrarError(campo, "El teléfono ingresado no es válido.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "direccionUser") {
                    if (!validarDireccion(campo.value)) {
                        mostrarError(campo, "La dirección ingresada debe constar de calle,número, piso y letra.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "provinciaUser") {
                    if (!validarProvinciaLocalidad(campo.value)) {
                        mostrarError(campo, "La provincia ingresada no es válida.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "localidadUser") {
                    if (!validarProvinciaLocalidad(campo.value)) {
                        mostrarError(campo, "La localidad ingresada no es válida.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "cpUser") {
                    if (!validarCp(campo.value)) {
                        mostrarError(campo, "El CP ingresado no es válido.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }
            }
            
            /*FORMULARIO DATOS PAGO*/
            if (formulario.id === "formularioDatosPago") {
                if (campoId === "titularTarjeta") {
                    if (!validarTitular(campo.value)) {
                        mostrarError(campo, "El titular debe de set el nombre y apellidos.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "numeroTarjeta") {
                    if (!validarTarjeta(campo.value)) {
                        mostrarError(campo, "El número de tarjeta debe se de 18 dígitos.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "validezTarjeta") {
                    if (!validarValidez(campo.value)) {
                        mostrarError(campo, "Introduce una fecha correcta.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }

                if (campoId === "cvvTarjeta") {
                    if (!validarCvv(campo.value)) {
                        mostrarError(campo, "El cvv de la tarjeta debe se de 3 dígitos.");
                        isValid = false;
                    } else {
                        ocultarError(campo);
                    }
                }
            }

        }

        if (isValid) {
            if (formulario.id === "formularioLogin") {
                // alert("Sesión iniciada con éxito");
            } else if (formulario.id === "formularioRegistro") {
                //alert("Usuario creado con éxito");
            } else if (formulario.id === "formularioCrearAdmin") {
                //alert("Administrador creado con éxito");
            } else if (formulario.id === "formularioArticulo") {
                //alert("Artículo creado con éxito");
            } else if (formulario.id === "formularioProducto") {
                //alert("Producto creado con éxito");
            } else if (formulario.id === "formularioDatosUser") {
                //alert("Datos actualizados con éxito");
            }  else if (formulario.id === "formularioDatosPago") {
                //alert("Datos de pago actualizados con éxito");
            }
        }

        return isValid;
    }

    // Valida cada campo usando las regex correspondientes
    function validarCampo(campo) {
        var campoId = campo.id;

        /*FORMULARIO LOGIN*/
        if (campoId === "emailLogin") {
            if (!validarEmail(campo.value)) {
                mostrarError(campo, "El email ingresado no es válido.");
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "passLogin") {
            if (!validarPassword(campo.value)) {
                mostrarError(
                    campo,
                    "La contraseña debe tener una longitud entre 5 y 9 caracteres, incluir al menos un número y una mayúscula."
                );
            } else {
                ocultarError(campo);
            }
        }

        /*FORMULARIO REGISTRO*/
        if (campoId === "nombreRegistro") {
            if (!validarNombre(campo.value)) {
                mostrarError(
                    campo,
                    "El nombre debe ser una palabra que empiece con mayúscula y sin números."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "apellidosRegistro") {
            if (!validarApellidos(campo.value)) {
                mostrarError(
                    campo,
                    "Los apellidos deben ser mínimo dos palabras que empiecen con mayúscula y sin números."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "emailRegistro") {
            if (!validarEmail(campo.value)) {
                mostrarError(campo, "El email ingresado no es válido.");
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "passRegistro") {
            if (!validarPassword(campo.value)) {
                mostrarError(
                    campo,
                    "La contraseña debe tener una longitud entre 5 y 9 caracteres, incluir al menos un número y una mayúscula."
                );
            } else {
                ocultarError(campo);
            }
        }

        /*FORMULARIO CREAR ADMIN*/
        if (campoId === "nombreAdmin") {
            if (!validarNombre(campo.value)) {
                mostrarError(
                    campo,
                    "El nombre debe ser una palabra que empiece con mayúscula y sin números."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "apellidosAdmin") {
            if (!validarApellidos(campo.value)) {
                mostrarError(
                    campo,
                    "Los apellidos deben ser mínimo dos palabras que empiecen con mayúscula y sin números."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "emailAdmin") {
            if (!validarEmail(campo.value)) {
                mostrarError(campo, "El email ingresado no es válido.");
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "passAdmin") {
            if (!validarPassword(campo.value)) {
                mostrarError(
                    campo,
                    "La contraseña debe tener una longitud entre 5 y 9 caracteres, incluir al menos un número y una mayúscula."
                );
            } else {
                ocultarError(campo);
            }
        }

        /*FORMULARIO ARTICULO*/
        if (campoId === "tituloArticulo") {
            if (!validarTituloArticulo(campo.value)) {
                mostrarError(
                    campo,
                    "El título debe ser mínimo una palabra que empiece con mayúscula, máximo 70 caracteres, puede llevar números y espacios."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "descripcionArticulo") {
            if (!validarDescripcionArticulo(campo.value)) {
                mostrarError(
                    campo,
                    "No se permiten espacios al principio ni al final, debe ser texto plano sin caracteres especiales, salvo interrogaciones, exclamaciones, puntos y comas."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "fotoArticulo") {
            if (!validarFoto(campo.value)) {
                mostrarError(
                    campo,
                    "La imagen debe de estar en formato jpeg, jpg o png"
                );
            } else {
                ocultarError(campo);
            }
        }

        /*FORMULARIO PRODUCTO*/
        if (campoId === "nombreProducto") {
            if (!validarNombreProducto(campo.value)) {
                mostrarError(
                    campo,
                    "El nombre debe ser mínimo una palabra que empiece con mayúscula, máximo 70 caracteres, puede llevar números y espacios."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "descripconProducto") {
            if (!validarDescripcionProducto(campo.value)) {
                mostrarError(
                    campo,
                    "No se permiten espacios al principio ni al final, debe ser texto plano sin caracteres especiales, salvo interrogaciones, exclamaciones, puntos y comas."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "precioProducto") {
            if (!validarPrecioProducto(campo.value)) {
                mostrarError(
                    campo,
                    "El precio debe ser un número."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "fotoProducto") {
            if (!validarFoto(campo.value)) {
                mostrarError(
                    campo,
                    "La imagen debe de estar en formato jpeg, jpg o png"
                );
            } else {
                ocultarError(campo);
            }
        }

        /*FORMULARIO DATOS USER*/
        if (campoId === "dniUser") {
            if (!validarDni(campo.value)) {
                mostrarError(
                    campo,
                    "El DNI ingresado no es válido."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "telefonoUser") {
            if (!validarTelefono(campo.value)) {
                mostrarError(
                    campo,
                    "El teléfono ingresado no es válido."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "direccionUser") {
            if (!validarDirección(campo.value)) {
                mostrarError(
                    campo,
                    "La dirección ingresada debe constar de calle,número, piso y letra."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "provinciaUser") {
            if (!validarProvinciaLocalidad(campo.value)) {
                mostrarError(
                    campo,
                    "La provincia ingresada no es válidaa."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "localidadUser") {
            if (!validarProvinciaLocalidad(campo.value)) {
                mostrarError(
                    campo,
                    "La localidad ingresada no es válida."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "cpUser") {
            if (!validarCp(campo.value)) {
                mostrarError(
                    campo,
                    "La lCP no es válido."
                );
            } else {
                ocultarError(campo);
            }
        }

        /*FORMULARIO DATOS PAGO*/
        if (campoId === "titularTarjeta") {
            if (!validarTitular(campo.value)) {
                mostrarError(
                    campo,
                    "El titular debe de set el nombre y apellidos."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "numeroTarjeta") {
            if (!validarTarjeta(campo.value)) {
                mostrarError(
                    campo,
                    "El número de tarjeta debe se de 18 dígitos."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "validezTarjeta") {
            if (!validarValidez(campo.value)) {
                mostrarError(
                    campo,
                    "Introduce una fecha correcta."
                );
            } else {
                ocultarError(campo);
            }
        }

        if (campoId === "cvvTarjeta") {
            if (!validarCvv(campo.value)) {
                mostrarError(
                    campo,
                    "El cvv de la tarjeta debe se de 3 dígitos."
                );
            } else {
                ocultarError(campo);
            }
        }
    }

    /*FORMULARIO LOGIN*/
    function validarNombre(nombre) {
        return nombreRegex.test(nombre);
    }

    function validarApellidos(apellidos) {
        return apellidosRegex.test(apellidos);
    }

    // Valida el email usando la expresión regular correspondiente
    function validarEmail(email) {
        return emailRegex.test(email);
    }

    // Valida la contraseña usando la expresión regular correspondiente
    function validarPassword(password) {
        return passwordRegex.test(password);
    }

    // Valida el titulo del articulo usando la expresión regular correspondiente
    function validarTituloArticulo(tituloArticulo) {
        return tituloArticuloRegex.test(tituloArticulo);
    }

    // Valida el cuerpo del articulo usando la expresión regular correspondiente
    function validarDescripcionArticulo(descripcionArticulo) {
        return descripcionArticuloRegex.test(descripcionArticulo);
    }

    // Valida la foto del articulo usando la expresión regular correspondiente
    function validarFoto(fotoArticulo) {
        return fotoRegex.test(fotoArticulo);
    }


    /*FORMULARIO PRODUCTO*/
    function validarNombreProducto(nombreProducto) {
        return nombreProductoRegex.test(nombreProducto);
    }

    function validarDescripcionProducto(descripconProducto) {
        return descripcionProductoRegex.test(descripconProducto);
    }

    function validarPrecioProducto(precioProducto) {
        return precioRegex.test(precioProducto);
    }

    function validarFoto(fotoProducto) {
        return fotoRegex.test(fotoProducto);
    }

    /*FORMULARIO DATOS USER*/
    function validarDni(dniUser) {
        return dniRegex.test(dniUser);
    }

    function validarTelefono(telefonoUser) {
        return telefonoRegex.test(telefonoUser);
    }

    function validarDireccion(direccionUser) {
        return direccionRegex.test(direccionUser);
    }

    function validarProvinciaLocalidad(provinciaUser) {
        return provinciaLocalidadRegex.test(provinciaUser);
    }

    function validarProvinciaLocalidad(localidadUser) {
        return provinciaLocalidadRegex.test(localidadUser);
    }

    function validarCp(cpUser) {
        return codigoPostalRegex.test(cpUser);
    }

    /*FORMULARIO DATOS PAGO*/
    function validarTitular(titularTarjeta) {
        return titularRegex.test(titularTarjeta);
    }

    function validarTarjeta(numeroTarjeta) {
        return numeroTarjetaRegex.test(numeroTarjeta);
    }

    function validarValidez(validezTarjeta) {
        return validezRegex.test(validezTarjeta);
    }

    function validarCvv(cvvTarjeta) {
        return cvvRegex.test(cvvTarjeta);
    }

    // Muestra un mensaje de error debajo del campo
    function mostrarError(campo, mensaje) {
        campo.classList.add("is-invalid");
        campo.classList.remove("is-valid");
        var errorSpan = campo.nextElementSibling;
        errorSpan.textContent = mensaje;
        errorSpan.style.color = "red";
    }

    // Oculta el mensaje de error y remueve las clases de error
    function ocultarError(campo) {
        var errorSpan = campo.nextElementSibling;
        errorSpan.textContent = "";
        campo.classList.remove("is-invalid");
        errorSpan.classList.remove("error-message-visible");
    }
});
