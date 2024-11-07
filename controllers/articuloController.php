<?php
require_once 'models/articuloModelo.php';
class articuloController{
    //INDEX DE LA WEB
    public function index(){
        $articulo = new Articulo;
        $articulos = $articulo->getNoticias(5);
        $articuloDestacado = $articulo->getDestacados(3);
        $articuloSlider1 = $articulo->getSlider(1);

        //Renderizar vista para mostrar el index de articulos
        require_once 'views/articulo/slider.php';
        require_once 'views/articulo/novedades.php';
        require_once 'views/articulo/noticias.php';
        require_once 'views/articulo/mejor_valorados.php';
    }

    //Gestion de articulos
    public function gestion(){
        Utils::isAdmin();

        $articulo = new Articulo();
        $articulos = $articulo->getAll();
        require_once 'views/articulo/gestionArticulo.php';
    }

    //Para ver la pagina del articulo
    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $articulo = new Articulo();
            $articulo->setId($id);
            $art = $articulo->getOne();
        }
        require_once 'views/articulo/verArticulo.php';
    }

    //Llamada a la vista de crear articulo
    public function crearArticulo(){
        Utils::isAdmin();
        require_once 'views/articulo/crearArticulo.php';
    }

    //Crear y guardar articulo
    public function saveArticulo(){
        Utils::isAdmin();
      
        if(isset($_POST)){
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $localizacion = isset($_POST['localizacion']) ? $_POST['localizacion'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;

            if($titulo && $categoria && $descripcion && $localizacion){
                $articulo = new Articulo();
                $articulo->setTitulo($titulo);
                $articulo->setCategoria_id($categoria);
                $articulo->setDescripcion($descripcion);
                $articulo->setLocalizacion_id($localizacion);

                //Guardar la imagen
                if(isset($_FILES['foto'])){
                    $file = $_FILES['foto'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    //Tipos de archivo admitidos
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                        
                        //Si no existe el directorio uploads lo crea para guardar las imagenes que se suban
                        if(!is_dir('assets/uploads/images')){
                            mkdir('assets/uploads/images', 0777, true);
                        }

                        $articulo->setFoto($filename);
                        //Mueve el archivo temporal de foto a su ubicacion definitiva
                        move_uploaded_file($file['tmp_name'], 'assets/uploads/images/'.$filename); 
                    }
                    $_SESSION['crear_result'] = 0;
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $articulo->setId($id);
                    $save = $articulo->edit();
                    $_SESSION['crear_result'] = 1;
                }else{
                    $save = $articulo->saveArticulo();
                    $_SESSION['crear_result'] = 1;
                }

                if($save){
                    $_SESSION['articulo'] = 'complete';
                    $_SESSION['crear_result'] = 1;
                }else{
                    $_SESSION['articulo'] = 'failed';
                    $_SESSION['crear_result'] = 0;
                }
            }else{
                $_SESSION['articulo'] = 'failed';
                $_SESSION['crear_result'] = 0;
            }
        }else{
            $_SESSION['articulo'] = 'failed';
            $_SESSION['crear_result'] = 0;
        }
        header("Location:".base_url.'articulo/gestion?errorCrearArticulo='.($_SESSION['crear_result'] ? '0': '1'));
    }

    //Editar articulo ya subido
    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $articulo = new Articulo();
            $articulo->setId($id);
            $art = $articulo->getOne();

            require_once 'views/articulo/crearArticulo.php';
        }else{
            header("Location:".base_url.'articulo/gestion');
        }
    }

    //Borrar articulo
    public function eliminar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $articulo = new Articulo();
            $articulo->setId($id);

            //Inicio borrar foto de carpeta
            $imagen = $articulo->obtenerFoto($id);
            $articulo->setFoto($imagen->imagen);

            if(file_exists(('uploads/images/'.$articulo->getFoto()))){
                unlink('uploads/images'.$articulo->getFoto());
            }
            //Fin borrar foto de carpeta

            $delete = $articulo->delete();

            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }
        header("Location:".base_url.'articulo/gestion');
    }


    //ENLACES DEL FOOTER
    public function faq(){
        require_once 'views/footer/faq.php';
    }

    public function terminos(){
        require_once 'views/footer/terminos.php';
    }

    public function politica(){
        require_once 'views/footer/politica.php';
    }
}