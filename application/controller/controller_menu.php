<?php
if (!isset($_SESSION)) { session_start(); }
?>
<?php
include 'application/model/model_precio.php';
class Controller_Menu extends Controller
{
    function nuevo(){
        $precio = new Model_Precio();
        $precio->crearPrecio($_POST['precio']);
        $precio->cargarABd();
        //$precio->cargarId();
        if(isset($_POST['descripcion'])&&isset($_POST['precio'])&&isset($_FILES["file"]["name"])) {
            $this->model->crearMenu($_POST['descripcion'], $_FILES["file"], $_POST['precio'],$_POST['idPuntoDeVenta']);
        }
        $this->model->cargarABd();
        header("location:/puntoDeVenta/index?c=".$_POST['idPuntoDeVenta']);
    }

    function modificar()
    {
        $precio = new Model_Precio();
        $idPuntoDeVenta = $_POST['idPuntoDeVenta'];
        $precio->crearPrecio($_POST['precio']);
        $precio->cargarABd();
        $this->model->grabarModificacionMenu($_POST['idMenu'],$_FILES["file"],$_POST['descripcion'],$precio->consultarId(),$idPuntoDeVenta);
        $precio->eliminarSiEsNecesario();
    
    }

    function eliminar()
    {
        $this->model->eliminarMenu($_GET['c'],urldecode($_GET['variable']));
        header("location:/puntoDeVenta/index?c=".$_GET['c']); 

    }
}