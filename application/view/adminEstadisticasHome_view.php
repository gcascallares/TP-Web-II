<?php
	if(!isset($_SESSION["login"])){
		echo "INISIA SESION WACHO";
        echo "<br>";
        echo "<a href='/login'>Iniciar sesion</a>";
        exit;
	}
  ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nombre Pagina</title>
    <link rel="stylesheet" href="../application/resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../application/resources/css/estilosIndex.css">
    <script src="../application/resources/js/bootstrap.min.js"></script>
    <script src="../application/resources/js/jquery-3.3.1.min.js"></script>
    <script src="../application/resources/js/comercioHome.js"></script>
</head>
<body>
	<div class="container-fluid px-0">
		<div class="header d-flex justify-content-between align-items-center">
			<div class="logo"> ACA VA EL LOGO Y EL NOMBRE</div>
			<div class="bar d-flex">
						<div class="sesion"><a href="adminHome.php">Bienvenido "Admin"</a></div>
						<div class="sesion"><a href="/administradorDeSistema/peticionDeComercios">Comercios</a></div>
						<div class="sesion"><a href="/administradorDeSistema/peticionDeDeliverys">Deliverys</a></div>
						<div class="sesion"><a href="/login/cerrarsesion">Cerrar sesión</a></div>
			</div>
		</div>
	
		<br>
		<h1>Estadisticas generales:</h1>
<form method="POST" action="/administradorDeSistema/estadisticasDatos" enctype="application/x-www-form-urlencodes">
		<label>Desde</label>
		<input type="date" name="desde">

		<label>Hasta</label>
		<input type="date" name="hasta">
		<input type="submit" name="buscar" value="buscar">
</form>

<br>
		<h3>Total ganancias:</h3>

<br>
		<h3>Entregas mensuales:</h3>

<br>
		<h3>Top rankin comercios que mas vendieron:</h3>

<br>
		<h3>Top rankin deliverys que mas entregaron:</h3>

	</div>
</body>
</html>