<?php
include 'application/model/model_menu.php';
include 'application/model/model_carrito.php';
include 'application/model/model_usuario.php';

class Controller_Delivery extends Controller{
	
	public function pedidoRetirado(){
		$delivery = new Model_usuario();
		$retira = $delivery->retirarPedidoDelivery($_GET['id']);
		$this->pedidosEnCurso();
	 }
	 public function pedidoEntregado(){
		$delivery = new Model_usuario();
		$entrega = $delivery->entregarPedidoDelivery($_GET['id']);
		$this->pedidosEnCurso();
	}
	 public function pedidosEnCurso(){
		$id = $_SESSION['id'];
		$delivery = new Model_Usuario();
        $pedidos = $delivery->listarPedidosEnCursoDelivery($id);
        $this->view->generateSt('deliveryEstadoPedidos.php',$pedidos);
	 }
	 public function pedidosDisponibles(){
		//$id = $_SESSION['id'];
		$delivery = new Model_Usuario();
        $pedidos = $delivery->listarPedidosDisponibles();
        $this->view->generateSt('deliveryHome.php',$pedidos);
	 	
	 }
	  public function pedidosRealizados(){
		$id = $_SESSION['id'];
		$delivery = new Model_usuario();
        $pedidos = $delivery->listarPedidosRealizadosDelivery($id);
        $this->view->generateSt('deliveryEstadoPedidos.php',$pedidos);
	 }
	 
	 public function pedidoAceptado(){
		$delivery = new Model_usuario();
		$delivery->aceptarPedidoDelivery($_GET['id'],$_SESSION['id']);
		//$this->view->generateSt('deliveryEstadoPedidos.php');
		header("location:/delivery/pedidosEnCurso"); 
	 }
	 
	 public function registrar(){
        $this->view->generateSt("registrar-delivery_view.php");
    }
    public function validarDelivery(){
        $usuario = new Model_Usuario();
        $username = $_POST['nombreUsuario'];
        $password = md5($_POST['clave']);
        $email = $_POST['email'];
        $name = $_POST['nombre'];
        $surname = $_POST['apellido'];
        $tel = $_POST['telefono'];
        $usuario->insertarDelivery($username,$password,$email,$name,$surname,$tel);
        header("location:/login");
    }
}