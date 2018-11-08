<?php

include 'application/model/model_menu.php';
include 'application/model/model_carrito.php';
include 'application/model/model_usuario.php';


class Controller_Pedido extends Controller{

	public function nuevoPedido(){
		$id = $this->model->cargarPedidoABd($_GET['c'],$_SESSION['id']);
		$horaPedido = $this->model->cargarHoraDeGenerado($_GET['c'],$_SESSION['id']);
		header("location:/cliente/mostrarPedidos");
	 }
	 
	 public function mostrarDatos($id){
		 $pedido = $this->model->traerDatosParaDelivery($id);
		 //EN $pedido tengo el inner join con comercio y cliente asi tengo las dos direcciones. domicilio es la del cliente, direccion es la del comercio
		echo $pedido['domicilio']." - ".$pedido['direccion'];

	 }
}