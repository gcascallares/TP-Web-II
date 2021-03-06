<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<?php
require_once 'modelo_conexion_base_de_datos.php';

class Model_Pedido extends Model
{
    private $idPedido;
    private $fechaHoraEntrega;
    private $fechaHoraRetiro;
    private $Usuario_idCliente;
    private $Usuario_idDelivery;
    private $idPuntoDeVenta;
        
    public function cargarPedidoABd($idComercio, $idCliente, $total)
    { ///RETORNA ID DEL PEDIDO QUE INGRESASTE
        $conn =BaseDeDatos::conectarBD();
        //ELIJO UN PUNTO DE VENTA
        $sql = "select * from puntodeventa where Comercio_idComercio = ".$idComercio." LIMIT 1;";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $idPuntoDeVenta = $rows['idPuntoDeVenta'];
        $sql = "insert into pedido (Usuario_idCliente,idPuntoDeVenta,montoTotal) values (".$idCliente.",".$idPuntoDeVenta.",".$total.")";
        $result = mysqli_query($conn, $sql);
        $sql2 = "select max(idPedido) from pedido";
        $result2 = mysqli_query($conn, $sql2);
        $pedido = mysqli_fetch_assoc($result2);
        $idPedido = $pedido['max(idPedido)'];
        $this->idPedido = $idPedido;
        return $idPedido;
    }
    
    public function cargarHoraDeGenerado($idComercio, $idCliente)
    {
        $conn =BaseDeDatos::conectarBD();
        $sql2 = "select max(idPedido) from pedido";
        $result2 = mysqli_query($conn, $sql2);
        $pedido = mysqli_fetch_assoc($result2);
        $idPedido = $pedido['max(idPedido)'];
        $sql = "update Pedido set fechaHoraGenerado=(select now()) where idPedido=".$idPedido.";";
        $result = mysqli_query($conn, $sql);
        return $idPedido;
    }

    public function crearPedido()
    {
    }

    public function traerDatosParaDelivery($id)
    {
        $conn =BaseDeDatos::conectarBD();
        $sql = "select * from pedido p inner join usuario c on p.Usuario_idCliente = c.idUsuario
        inner join puntodeventa pdv on pdv.idPuntoDeVenta = pdv.idPuntoDeVenta";
        $result = mysqli_query($conn, $sql);
        $pedido = mysqli_fetch_assoc($result);
        return $pedido;
    }
    
    public function retirarPedido($id)
    {
        $conn = BaseDeDatos::conectarBD();
        $sql = "update Pedido set fechaHoraRetiro=(select now()) where idPedido=".$id.";";
        $result = mysqli_query($conn, $sql);
    }
    public function entregarPedido($id)
    {
        $conn = BaseDeDatos::conectarBD();
        $sql = "update Pedido set fechaHoraEntrega=(select now()) where idPedido=".$id.";";
        $result = mysqli_query($conn, $sql);
    }
    public function aceptarPedido($id, $idDelivery)
    {
        $conn = BaseDeDatos::conectarBD();
        $sql = "update Pedido set Usuario_idDelivery=(".$idDelivery." where idPedido=".$id.";";
        $result = mysqli_query($conn, $sql);
    }
    public function listarPedidosEnCurso($id)
    {
        $conn =BaseDeDatos::conectarBD();
        $sql = "select p.idPedido as id, u.domicilio dom, pdv.direccion as dir,p.fechaHoraRetiro as retiro, p.fechaHoraEntrega as entrega
		from Pedido as p inner join Usuario as u on u.idUsuario = p.Usuario_idCliente
		inner join puntodeventa as pdv on pdv.idPuntoDeVenta = p.idPuntoDeVenta
		where p.Usuario_idDelivery = ".$id." and p.fechaHoraEntrega is null;";
    }
    
    public function listarPedidosRealizados($id)
    {
        $conn =BaseDeDatos::conectarBD();
        $sql = "select p.idPedido as id, u.domicilio dom, pdv.direccion as dir,p.fechaHoraRetiro as retiro, p.fechaHoraEntrega as entrega
		from Pedido as p inner join Usuario as u on u.idUsuario = p.Usuario_idCliente
		inner join puntodeventa as pdv on pdv.idPuntoDeVenta = pdv.idPuntoDeVenta
		where p.Usuario_idDelivery = ".$id." and p.fechaHoraEntrega is not null;";
    }

    public function borrarPedido($id)
    {
        $conn =BaseDeDatos::conectarBD();
        $sql = "delete from pedido where idPedido=".$id.";";
        $result = mysqli_query($conn, $sql);
    }
    public function buscarPedidosDemorados()
    {
        $conn =BaseDeDatos::conectarBD();
        // $pedidosSinDelivery = listarPedidosSinDelivery();
        // listarPedidosDemorados($pedidosSinDelivery);
        $sql = "select * from pedido where timestampdiff (minute,fechaHoraGenerado,now()) >= 1 and Usuario_idDelivery IS NULL;";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
    
    // private function listarPedidosSinDelivery(){
    // 	$conn =BaseDeDatos::conectarBD();
    // 	$sql = "select * from pedido where Usuario_idDelivery = null;";
    // 	$result = mysqli_query($conn,$sql);
    // }
    // private function listarPedidosDemorados($lista){
    // 	$resultArray = [];
    // 	if(mysqli_num_rows($lista) >= 1){
    // 		while($rows = mysqli_fetch_assoc($lista)){
    // 			if( ... ){
    // 				$resultArray[] = "pepe";
    // 			}
    // 		}
    // 	}
    // }
}
