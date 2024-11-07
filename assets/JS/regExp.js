// EXPRESIONES REGULARES

var nombreRegex = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/;
var apellidosRegex = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/;
var emailRegex = /^\S+@\S+\.\S+$/;
var passwordRegex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{5,9}$/;
var tituloArticuloRegex = /[A-Z][A-Za-z0-9\s]{0,68}/;
var descripcionArticuloRegex = /^[A-Za-z0-9,.;:¡!¿?áéíóúüñÁÉÍÓÚÜ()\s\S]*$/;
var fotoRegex = /\.(jpg|jpeg|png|gif|bmp)$/;
var nombreProductoRegex = /^[A-Za-z0-9\s]{1,69}$/;
var descripcionProductoRegex = /^[A-Za-z0-9,.;¡!¿?áéíóúüñÁÉÍÓÚÜ()\s]{0,300}$/;
var precioRegex = /^\d+(\.\d{1,2})?$/;
var dniRegex = /^[0-9]{8}[A-Za-z]$/;
var telefonoRegex = /^[679]{1}[0-9]{8}$/;
var direccionRegex = /^[a-zA-Z\s]+\d+[a-zA-Z]?(,?\s*\d+[a-zA-Z]?)?$/;
var provinciaLocalidadRegex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
var codigoPostalRegex = /^\d{5}$/;
var titularRegex = /^([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+)(\s+([A-Za-zÑñÁáÉéÍíÓóÚú]+['\-]{0,1}[A-Za-zÑñÁáÉéÍíÓóÚú]+))*$/;
var numeroTarjetaRegex = /^\d{18}$/;
var cvvRegex = /^\d{3}$/;
var validezRegex = /^(20\d{2})-(0[1-9]|1[0-2])$/;

