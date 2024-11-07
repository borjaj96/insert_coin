<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'assets/libs/vendor/autoload.php';

require_once 'models/pedidoModelo.php';
require_once 'models/usuarioModelo.php';

class pedidoController{
    //Carga de vista plataforma de pago
    public function hacerPedido(){
        // Verificar si el usuario está autenticado
        if (isset($_SESSION['identity'])) {
            // Obtener el objeto Usuario de la sesión
            $usuario = new Usuario();
            $usuario->setId($_SESSION['identity']->id);
    
            // Obtener los datos del usuario desde la base de datos
            $usuarioModelo = new Usuario();
            $usuario = $usuarioModelo->getOne($usuario);
            $tarjetaFormateada = chunk_split($usuario->tarjeta, 4, ' ');
    
            // Cargar la vista y pasar los datos del usuario
            require_once 'views/pedido/hacerPedido.php';
        } else {
            // El usuario no está autenticado, redireccionar a la página de inicio de sesión
            header("Location: " . base_url . "usuario/acceso");
        }
        require_once 'views/pedido/hacerPedido.php';
    }

    //Agregar pedido a bbdd una vez se confirme
    public function add(){
        if (isset($_SESSION['identity'])) {
            $comprador_id = $_SESSION['identity']->id;
            $stats = Utils::infoCarrito();
            $coste = $stats['total'];
    
            // Comprobar validez y cvv
            $pedido = new Pedido();
            $pedido->setComprador_id($comprador_id);
            $pedido->setCoste($coste);
    
            // Obtener los valores ingresados en el formulario
            $validezTarjetaIngresada = $_POST['validezTarjeta'];
            $cvvIngresado = $_POST['cvvTarjeta'];

            if ($pedido->compruebaTarjeta($validezTarjetaIngresada, $cvvIngresado)) {
                // Validez y cvv coinciden, guardar en la BBDD
                $save = $pedido->save();
    
                // Guardar lineaPedidos
                $saveLinea = $pedido->saveLinea();
    
                if ($save && $saveLinea) {
                    $_SESSION['pedido'] = "complete";
                } else {
                    $_SESSION['pedido'] = "failed";
                }
    
                $this->deleteCarrito();
                header("Location: " . base_url . "pedido/confirmado");
                exit();
            } else {
                // Validez y cvv no coinciden
                $_SESSION['pedido'] = "failed";
                
                header("Location: " . base_url . "pedido/hacerPedido?error=1");
                exit();
            }
        } else {
            // Redirigir al index
            header("Location: " . base_url."usuario/miPerfil");
            exit();
        }
    }

    //Vaciar carrito, se llama en add para vaciar carrito una vez realizado el pedido
    public function deleteCarrito() {
        if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
            $usuario_id = $_SESSION['identity']->id;
            
            foreach ($_SESSION['carrito'] as $key => $item) {
                if ($item['usuario_id'] == $usuario_id) {
                    unset($_SESSION['carrito'][$key]);
                }
            }
        }
    }

    //Carga de vista y datos de confirmacion de pedido
    public function confirmado(){
        if(isset($_SESSION['identity'])){
           
            $usuario = new Usuario;
            // Obtener los datos del usuario desde la base de datos
            $usuarioModelo = new Usuario();
            $usuario = $usuarioModelo->getOne($usuario);
            $tarjetaFormateada = chunk_split($usuario->tarjeta, 4, ' ');
            $identity = $_SESSION['identity'];

            //Obtener los datos de pedido
            $pedido = new Pedido();
            $pedido->setComprador_id($identity->id);

            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);

            // Llamar al método correo()
            $this->correo($usuario, $pedido);
        }
        require_once 'views/pedido/confirmado.php';
    }

    //Metodo para generar una factura en PDF
    public function factura(){
        //Crear una instancia de mpdf
        $mpdf = new \Mpdf\Mpdf();
        //Obtener la sesión 
        $identity = $_SESSION['identity'];
        //Obtener los datos de pedido
        $pedido = new Pedido();
        //Llamada a métodos
        $pedido->setComprador_id($identity->id);
        $pedido = $pedido->getOneByUser();

        //Crear una instancia de usurio
        $usuario = new Usuario;
        //Obtener los datos del usuario desde la base de datos
        $usuarioModelo = new Usuario();
        $usuario = $usuarioModelo->getOne($usuario);
        //Formatear los datos de la tarjeta
        $tarjetaFormateada = chunk_split($usuario->tarjeta, 4, ' ');

        //Obtener los datos de pedido
        $pedido = new Pedido();
        $pedido->setComprador_id($identity->id);

        $pedido = $pedido->getOneByUser();

        $pedido_productos = new Pedido();
        $productos = $pedido_productos->getProductosByPedido($pedido->id);
    
        // Renderizar la vista y capturar el resultado HTML
        ob_start();
        require_once 'views/pedido/factura.php';
        $html = ob_get_clean();
        //Pasa el contenido de html al objeto mpdf
        $mpdf->WriteHTML($html);
        
        $html = ob_end_clean(); 
        //Nombre del archivo
        $filename = 'factura.pdf';
        //Generar pdf
        $mpdf->Output($filename, 'I');
    }

    //Metodo para cargar la vista del historial de pedidos
    public function misPedidos(){
        Utils::isUser();
        $comprador_id = $_SESSION['identity']->id;
        $pedido = new Pedido();

        //Sacar los pedidos del usuario
        $pedido->setComprador_id($comprador_id);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedido/historial_pedidos.php';
    }

    //Detalles del pedido
    public function detalle(){
        Utils::isUser();
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $usuario = new Usuario;
            // Obtener los datos del usuario desde la base de datos
            $usuarioModelo = new Usuario();
            $usuario = $usuarioModelo->getOne($usuario);
            $tarjetaFormateada = chunk_split($usuario->tarjeta, 4, ' ');
            $identity = $_SESSION['identity'];

            //Obtener los datos de pedido
            $pedido = new Pedido();
            $pedido->setId($id);

            $pedido = $pedido->getOne();

            //Obtener los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);


            require_once 'views/pedido/detalle.php';
        }else{
            header("Location:". base_url ."pedido/misPedidos");
        }
    }

    //Método para enviar correos una vez se haya completado el pedido
    public function correo($usuario, $pedido){
        //Verificar si la variable $usuario está definida y no es nula
        if($usuario !== null && $usuario->email !== null) {

            //Crear una instancia de PHPMailer
            $mail = new PHPMailer(true);
        
            try {
                //Configurar los ajustes del servidor smtp
                $mail->isSMTP();
                //Indicar el correo para usar smtp
                $mail->Host = 'smtp.gmail.com';
                //Activar la autentificación smtp
                $mail->SMTPAuth = true;
                //Establecer el correo desde el cual se envía el email
                $mail->Username = 'hola.insert.coin@gmail.com';
                //Clave de autenticación de correo
                $mail->Password = 'wswsqnrhhlexetpc';
                //Tipo de encriptado
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                //Puerto para conectar el smtp
                $mail->Port = 465;
        
                //Establecer el remitente y el destinatario
                $mail->setFrom('hola.insert.coin@gmail.com', 'INSERTCOIN');
                //Agregar la dirección de correo del usuario como destinatario
                $mail->addAddress($usuario->email); 
        
                // Configurar el contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'PEDIDO COMPLETADO';
                $mail->Body = '<p>Enhorabuena '.$usuario->nombre.' tu pedido con <strong>identificador número: '.$pedido->id.'</strong> se ha completado con éxito.<br>
                                Tienes disponible tu factura para descargarla dentro de tu historial de pedidos desde la sección de Mi Perfil de tu cuenta.<br>
                                Gracias por confiar en <strong>INSERT COIN!</strong></p>';
                $mail->AltBody = 'Pedido completado.';
                $mail->CharSet = 'UTF-8';

                //Enviar el email
                $mail->send();
                //Cierro la conexión smtp
                $mail->smtpClose();
            } catch (Exception $e) {
                echo "No se pudo enviar el mensaje. Error del Mailer: {$mail->ErrorInfo}";
            }
        } else {
            echo 'No se pudo enviar el mensaje debido a que no se encontró la dirección de correo electrónico del usuario.';
        }
    }
}