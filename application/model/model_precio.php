<?php
class Model_Precio extends Model
{
 private $idPrecio;
 private $monto;
 private $porcentajeDescuento;
 public function __construct(){

 }
 public function crearPrecio($cantidad){
     $this->monto = $cantidad;
 }
 public function cargarABd(){
     $conn = mysqli_connect("localhost","root","admin","tpweb2db");
     $sql="select * from precio where monto='$this->monto';";
     $result = mysqli_query($conn,$sql);
     $numeroFilas=mysqli_num_rows($result);
     if($numeroFilas==0)
     {
         $sql = "insert into precio (monto,porcDesc) values('$this->monto','$this->porcentajeDescuento');";
         header("location:./index.php");
         mysqli_query($conn,$sql);
     }

 }
 public function consultarId(){
     return $this->idPrecio;
 }
}