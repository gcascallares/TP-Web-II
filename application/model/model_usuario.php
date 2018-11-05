<?php

class Model_Usuario extends Model{

  private $db;
  private $usuario;
  private $clave;

  public function __construct(){
   require_once 'modelo_conexion_base_de_datos.php';
   $db=BaseDeDatos::conectarBD();
 }

   public function validarlogin($u,$c){
   $db=BaseDeDatos::conectarBD();
 
    $sql= 'select Rol.tipo as rol from Usuario inner join Rol on Usuario.Rol_idRol = Rol.idRol where Usuario.nombreUsuario="'.$u.'" and Usuario.clave="'.$c.'"; ';
    
    $result=mysqli_query($db,$sql);
	$rows=mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result)==1){
		$rol=($rows['rol']);
		return $rol;
      }else{
        echo "Error al buscar el usuario";
        echo "<br>";
        echo "<a href='/main/index'>Volver</a>";
      }

   }

   public function cerrarsesion(){
    session_destroy();
    header("location:/main");
   }

   public function insertarCliente($username,$password,$email,$name,$surname,$direccion,$tel){
    $db=BaseDeDatos::conectarBD();
    $sql = "insert into Usuario (nombreUsuario,clave,email,nombre,apellido,direccion,telefono,Rol_idRol) values ('".$username."','".$password."','".$email."','".$name."','".$surname."','".$direccion."','".$tel."',2);";
    $result = mysqli_query($db,$sql);
   }
   public function insertarOperadorComercio($username,$password,$comercioId){
    $db=BaseDeDatos::conectarBD();
    $sql = "insert into Usuario (nombreUsuario,clave,Comercio_idComercio,Rol_idRol) values ('".$username."','".$password."','".$comercioId."',4);";
    $result = mysqli_query($db,$sql);
   }
   ///OBTENER ID DEL COMERCIO EN QUE TRABAJA
   public function obtenerIdComercio($username){
    $db=BaseDeDatos::conectarBD();
    $sql = "select Comercio_idComercio from Usuario where nombreUsuario = '".$username."';";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row['Comercio_idComercio'];
   }

   public function obtenerIdCliente($username){
    $db=BaseDeDatos::conectarBD();
    $sql = "select idUsuario from Usuario where nombreUsuario = '".$username."';";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row['idUsuario'];
   }
	
	public function mostrarPedidosCliente($id){
    $conn =BaseDeDatos::conectarBD();
    $sql = "select c.direccion as dir, p.idPedido as id,p.fechaHoraRetiro as retiro, p.fechaHoraEntrega as entrega
	from Pedido as p inner join Usuario as u on u.idUsuario = p.Usuario_idCliente
	inner join Comercio as c on c.idComercio = p.Comercio_idComercio
	where p.Usuario_idCliente = ".$id."";
	$result = mysqli_query($conn,$sql);
    return $result;
	}
	
	public function retirarPedidoDelivery($id){
		$conn = BaseDeDatos::conectarBD();
		$sql = "update Pedido set fechaHoraRetiro=(select now()) where idPedido=".$id.";";
		$result = mysqli_query($conn,$sql);
	}
	public function entregarPedidoDelivery($id){
		$conn = BaseDeDatos::conectarBD();
		$sql = "update Pedido set fechaHoraEntrega=(select now()) where idPedido=".$id.";";
		$result = mysqli_query($conn,$sql);
	}
		public function aceptarPedidoDelivery($id,$idDelivery){
		$conn = BaseDeDatos::conectarBD();
		$sql = "update Pedido set Usuario_idDelivery=".$idDelivery." where idPedido=".$id.";";
        $result = mysqli_query($conn,$sql);
        echo $sql;
	}
	
	public function listarPedidosEnCursoDelivery($id){
        $conn =BaseDeDatos::conectarBD();
        $sql = "select p.idPedido as id, u.domicilio dom, c.direccion as dir,p.fechaHoraRetiro as retiro, p.fechaHoraEntrega as entrega
		from Pedido as p inner join Usuario as u on u.idUsuario = p.Usuario_idCliente
		inner join Comercio as c on c.idComercio = p.Comercio_idComercio
		where p.Usuario_idDelivery = ".$id." and p.fechaHoraEntrega is null;";
		$result = mysqli_query($conn,$sql);
        return $result;
    }
    
    public function listarPedidosDisponibles($id){
        $conn = BaseDeDatos::conectarBD();
        $sql = "select p.idPedido as id, u.domicilio dom, c.direccion as dir,p.fechaHoraRetiro as retiro, p.fechaHoraEntrega as entrega
		from Pedido as p inner join Usuario as u on u.idUsuario = p.Usuario_idCliente
		inner join Comercio as c on c.idComercio = p.Comercio_idComercio
		where p.Usuario_idDelivery = ".$id." and p.fechaHoraEntrega is null;";
		$result = mysqli_query($conn,$sql);
        return $result;
	}
	
	public function listarPedidosRealizadosDelivery($id){
        $conn =BaseDeDatos::conectarBD();
        $sql = "select p.idPedido as id, u.domicilio dom, c.direccion as dir,p.fechaHoraRetiro as retiro, p.fechaHoraEntrega as entrega
		from Pedido as p inner join Usuario as u on u.idUsuario = p.Usuario_idCliente
		inner join Comercio as c on c.idComercio = p.Comercio_idComercio
		where p.Usuario_idDelivery = ".$id." and p.fechaHoraEntrega is not null;";
		$result = mysqli_query($conn,$sql);
        return $result;
	}
}
?>