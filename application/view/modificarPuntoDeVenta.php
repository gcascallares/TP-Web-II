<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restó | Modificar punto de venta</title>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Pinyon+Script" rel="stylesheet">

    <!-- <link rel="stylesheet" href="../application/resources/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../application/resources/css/styles-merged.css">
    <link rel="stylesheet" href="../application/resources/css/style.min.css">
    
    <!-- <script src="../application/resources/js/jquery-3.3.1.min.js"></script>
    <script src="../application/resources/js/bootstrap.min.js"></script> -->
    <script src="../application/resources/js/scripts.min.js"></script>
    <script src="../application/resources/js/custom.min.js"></script>
    

    <nav class="navbar navbar-default navbar-fixed-top probootstrap-navbar">
      <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="" title="uiCookies:FineOak">FineOak</a>
        </div>
        <?php
            $idComercio=$data2;
            ?>
      </div>
    </nav>
  </head>
<body>
<?php
	if (isset($data)) {
 		$idPuntoDeVenta=$data;
 	} 
 ?>

 <section class="probootstrap-section probootstrap-bg-white">
      <div class="container">
        <div class="row">
       
        <div class="col-md-12 text-center probootstrap-animate">
            <div class="probootstrap-heading"> <br><br><br><br><br>
              <h5 class="secondary-heading" style="color: black; font-size: 20px;">Ingresa los datos que deseas modificar del punto de venta:</h5>
            </div>
          </div>

             <form method="POST" action="/OperadorComercio/updatePuntoDeVenta?v=<?php echo $data2; ?>" enctype="application/x-www-form-urlencodes">
                <div class="col-md-4 col-md-offset-4">    

                  <div class="form-group">

                  <input type="hidden" name="idPuntoDeVenta" value="<?php echo $data; ?>" readonly>

                    <label>Dirección</label>
                    <div class="form-field">
                      <i class="icon icon-user2"></i>
                      <input type="text" class="form-control" name="direccion">
                    </div>
                  </div>
				  
				  <div class="form-group">
					  <label for="c_name">Localidad</label>
					 <div class="form-field">
						<select name="idLocalidad" class="form-control">
							<option value="0">Seleccione:</option>
								<?php
								  while ($rows = mysqli_fetch_assoc($data3)) {
								  echo "<option name=".$rows['idLocalidad']." value=".$rows['idLocalidad'].">".$rows['descripcionLocalidad'].", ".$rows['descripcionProvincia']."</option>";
								  }
								?>
						</select>
					</div>
				</div>
				  
                  <div class="form-group">
                    <label> Teléfono</label>
                    <div class="form-field">
                      <input type="text" class="form-control" name="telefono">
                    </div>
                  </div>
                </div>
             
              <div class="row">
                <div class="col-md-4 col-md-offset-4">
                  <input type="submit" name="submit" id="submit" value="Modificar" class="btn btn-lg btn-primary btn-block">
                </div>
              </div>
              
            </form>
            </div>
        </div>
    </section>



     </body>
<!-- FOOTER -->

        <section class="probootstrap-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 probootstrap-animate">
            <div class="probootstrap-footer-widget">
              <h3><a href="#">Acerca de Restó® </a></h3>
              <div class="row">
                <div class="col-md-6">
                  <a href="#"> Quiero ser Delivery</a>
                </div>
                <div class="col-md-6">
                  <a href="/operadorComercio/registrarComercio"> Quiero registrar mi Comercio</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 probootstrap-animate">
            <div class="probootstrap-footer-widget">
              <h3>Horarios</h3>
              <div class="row">
                <div class="col-md-4">
                  <p>Todos los días <br> ¡las 24hs!</p>
                </div>
                <div class="col-md-4">
                  <a href="#">Ayuda</a>
                </div>
                <div class="col-md-4">
                  <a href="#">Medios de pago</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="probootstrap-copyright">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <p class="copyright-text">&copy; 2018 <a href="#">Restó</a>. Todos los derechos reservados.
          </div>
          <div class="col-md-4">
            <ul class="probootstrap-footer-social right">
              <li><a href="#"><i class="icon-twitter"></i></a></li>
              <li><a href="#"><i class="icon-facebook"></i></a></li>
              <li><a href="#"><i class="icon-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

  </body>

</html>