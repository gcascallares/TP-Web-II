<?php
		if(!isset($_SESSION["login"])){
		echo "INICIA SESION WACHO";
        echo "<br>";
        echo "<a href='/login'>Iniciar sesion</a>";
        exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Home Comercios</title>
		<link rel="stylesheet" href="../application/resources/css/bootstrap.min.css">
		<link rel="stylesheet" href="../application/resources/css/estilosIndex.css">
		<link rel="stylesheet" href="../application/resources/css/comercioHome.css">
		<script src="../application/resources/js/jquery-3.3.1.min.js"></script>
		<script src="../application/resources/js/bootstrap.min.js"></script>
        <script src="../application/resources/js/comercioHome.js"></script>
	</head>
	<body>
		<div class="container-fluid px-0">
			<div class="header d-flex justify-content-between align-items-center">
				<div class="logo"> ACA VA EL LOGO Y EL NOMBRE</div>
					<div class="bar d-flex">
						<div class="sesion">Bienvenido "Comercio"</div>
						<div class="sesion"><a href="/operadorComercio/index?v=<?php echo $_SESSION['idComercio']; ?>">Volver a Puntos de venta</a></div>
						<div class="sesion"><a href="">Mis Ofertas</a></div>
						<div class="sesion"><a href="">Estadisticas</a></div>
						<div class="sesion"><a href="/operadorComercio/mostrarPedidos?c=<?php echo $data2; ?>">Pedidos</a></div>
						<div class="sesion"><a href="/login/cerrarsesion">Cerrar sesión</a></div>
					</div>
			</div>
			<div class="banner d-flex flex-column align-items-center">
				<div><h3>Banner</h3></div>
			</div>
                <div class="text-center mb-5">
                    <a href="/puntoDeVenta/mostrarformulariomenu?c=<?php echo $data2; ?>">
                        Agregar Menu
                    </a>
                </div>
            <div class="text-center">
				<h1>Mis Menus</h1>
            </div>
				<div class="container">
					<div class="row">
                        <?php
                       if(mysqli_num_rows($data) >= 1){ 
                        while($menues = mysqli_fetch_assoc($data)) {
                            echo"<div class='col-md-4'>
							<div class='card'>
								<img class='card-img-top' src='/application/resources/upload/".$menues['foto']."' alt='Mi Imagen' width='120px' height='120px'>
								<div class='card-body'>
									<h4 class='card-title'>Menu "."<span id ='menuId'>".$menues['idMenu']."</span></h4>
									<p class='card-text'>".$menues['descripcion']."</p>
									<p class='card-text'>".$menues['monto']."</p>
									<a href='/puntoDeVenta/mostrarformulariomodificarmenu?c=".$data2."&d=".$menues['descripcion']."' class='btn btn-primary'>Modificar</a>
									<a href='/menu/eliminar?c=".$data2."&variable=".$menues['descripcion']."' class='btn btn-danger text-white'>Eliminar</a>
									<a href='/menu/mostrarParaOfertar?c=".$data2."&variable=".$menues['descripcion']."' class='btn btn-warning text-white'>Ofertar</a>
                                </div>
                                </div> 
                            </div>";
                            }
                          }

                        ?>
					</div>
				</div>
				<!-- <a href="#" class="btn btn-primary mt-3">Ver Todos</a> -->
		
			<div class="title mt-4">
					<h1>Mis Ofertas</h1>
					<div class="container">
						<div class="row">	 
						<?php
                       if(mysqli_num_rows($data3) >= 1){ 
                        while($ofertas = mysqli_fetch_assoc($data3)) {
                            echo"<div class='col-md-4'>
							<div class='card'>
								<img class='card-img-top' src='/application/resources/upload/".$ofertas['foto']."' alt='Mi Imagen' width='120px' height='120px'>
								<div class='card-body'>
									<h4 class='card-title'>Menu "."<span id ='menuId'>".$ofertas['idMenu']."</span></h4>
									<p class='card-text'>".$ofertas['descripcion']."</p>
									<p class='card-text'>".$ofertas['monto']."</p>
									<a href='/puntoDeVenta/mostrarformulariomodificarmenu?c=".$data2."&d=".$ofertas['descripcion']."' class='btn btn-primary'>Modificar</a>
									<a href='/menu/eliminar?c=".$data2."&variable=".$ofertas['descripcion']."' class='btn btn-danger text-white'>Eliminar</a>
                                </div>
                                </div> 
                            </div>";
                            }
						  }
						  else{
							  echo "<div class='text-center w-50  mt-2 mx-auto'><h3> No hay ofertas disponibles </h3> </div>";
						  }

                        ?>
						
						</div>
					</div>
				<!-- <a href="#" class="btn btn-primary mt-3">Ver Todos</a> -->
			</div>
			<div class="estadisticas row text-center mt-5">
				<div class="col col-md-4 registro">
					<h5>Ventas</h5>
				</div>
				<div class="col col-md-4 registro">
				<h5>Pagos</h5>
				</div>
				<div class="col col-md-4 registro">
				<h5>Actividad</h5>
				</div>	
			</div>
				<!-- <div class="text-center mb-3">
				<a href="#" class="btn btn-primary mt-3">Ver Todos</a>
				</div> -->
		</div>
	</body>
</html>