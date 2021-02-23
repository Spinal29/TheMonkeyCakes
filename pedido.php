<!DOCTYPE html>
<?php 
			session_start();

	 ?>
	<html lang="zxx" class="no-js">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/logo.jpg">
		<meta charset="UTF-8">
		<title>The Monkey Cakes.</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">							
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>
			  <header id="header" id="home">
			    <div class="container main-menu">
			    	<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				        <a href="index.php"><img src="img/logo.jp" alt="" title="" /></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li class="menu-active"><a href="index.php">Home</a></li>
				       
				          <li><a href="conocenos.php">Conócenos</a></li>

				          <li><a href="productos.php">Repostería</a></li>

				          <?php 
				           if (isset($_SESSION['userID'])) {

				           	if($_SESSION['Tipo'] == 'usuario'){
                            echo '<li><a href="editar.php">Cuenta</a></li>';
				          	echo '<li><a href="pedido.php">Realizar pedido</a></li>';
				           	}
				           		elseif ($_SESSION['Tipo'] == 'admin') {
				           echo '<li><a href="cuentaAdmin.php">Registrar usuario</a></li>';
				           echo '<li><a href="administrador.php">Administrar usuarios</a></li>';
				           echo '<li><a href="listaPedidos.php">Administrar pedidos</a></li>';
				           	}

				           }
				           else {
				            echo '<li><a href="cuenta.php">Únetenos</a></li>';
				            echo '<li><a href="login.php">Iniciar Sesión</a></li>';
				           }
				           ?>

				          <li class="menu-has-children"><a href="">Red Social</a>
				            <ul>
				              <li><a href="https://www.facebook.com/TheMonkeyCakes/">Facebook</a></li>
				              <li><a href="https://www.instagram.com/themonkeyscakes.sv/?hl=es-la">Instagram</a></li>
				            </ul>
				          </li>	

				          <li>
				          	<?php 
				          	 if (isset($_COOKIE['userID'])) {
				           	if($_COOKIE['userID']!="No")
				           	{
				           	 $_SESSION['userID'] = $_COOKIE['userID'];
                             $_SESSION['Tipo'] = $_COOKIE['Tipo'];
                             $_SESSION['Key'] = $_COOKIE['Key'];
                            }
				           }
				          	if(isset($_SESSION['userID']))
				           {
				          echo '<form method = post>';
				          echo '<input type="submit"   name="closeSes" value = "Cerrar sesión" style="float:left;"></input>';
				          echo '</form>';
				           }

				           if (isset($_POST['closeSes'])) {
				           	session_unset();
	                        session_destroy();
	                          unset($_COOKIE['userID']);
	                       setcookie("userID","No",time() + (86400 * 30), "/");
                            unset($_COOKIE['Tipo']);
                            unset($_COOKIE['Key']);
	                        header('Location: /Panaderia/index.php');
				           }
				          	 ?>
				          </li>					          
				         
				            </ul>
				          </li>				              
				        </ul>
				      </nav><!-- #nav-menu-container -->		    		
			    	</div>
			    </div>
			  </header><!-- #header -->

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white" >
								Realizar pedidos			
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="pedido.php"> Pedidos</a></p>
							<p class="text-white link-nav" id = "titulo"  ></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
				
			<!-- Inicio pedidos -->
			<section class="cat-list-area section-gap">
				<div class="container">
					<form name = "ped" method="post">
					<table class="table table-bordered">
         				<thead class="thead-dark">
             				<tr>
                 				<th>Imagen</th>
                 				<th>Nombre</th>
                 				<th>Descripción</th>
                 				<th>Precio</th>
                 				<th>Cantidad</th>
             				</tr>
         				</thead>
         			<tbody>

         				<?php 
         				//Conexión:


							    include_once('class/conn.php');
							    $conex = new conexion();
							    $mysqli = $conex->cone;

					     //
							    $consulta = "select*from productos where Disponibilidad = 'si'";
							    $resultado = $mysqli->query($consulta);

							    while ($filas = mysqli_fetch_assoc($resultado)) {
						 ?>
             		<tr>
             			<td><?php echo '<img class="mx-auto d-block" src="'.$filas['Imagen'].'" style="width:200px; height:200px;">'; ?></td>
             			<td><?php echo $filas['Nombre'];  ?></td>
             			<td><?php echo $filas['Descripcion'];  ?></td>
             			<td><?php echo "$".$filas['Precio'];  ?></td>
             			<td>
             				<input name="<?php echo 'tb'.$filas['IDproducto'];?>" placeholder="Cantidad"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cantidad'"   type="number">
             			</td>
             		</tr>
             		 		<?php } ?>

             		 		
     				</form>
         			</tbody>
     				</table>
     				        <br>
     						<input type="submit" name="Realizar" id="realizarP" class="genric-btn primary circle"  value = "Realizar pedido" style="float:none; ">	</input>
     						<br>
     								<?php 	

     								
     								 //Obtener fecha:
							    $d = date("d");
                                $m = date("m");
                                $y = date("Y");
                                $fecha = $y."-".$m."-".$d;

                                //Generar identificador de pedido:


     								/*$MatPedidos[0]['IDped'] = 1; 
     				         		$MatPedidos[0]['Identificador'] = 1; 
     				         		$MatPedidos[0]['IDproducto'] = 2; 
     				         		$MatPedidos[0]['IDcliente'] = $_SESSION['userID']; 
     				         		$MatPedidos[0]['Fecha'] = 1; 
     				         		$MatPedidos[0]['Cantidad'] = 1; 
     				         		$MatPedidos[0]['Monto'] = 1; */

                            if (isset($_POST['Realizar'])) {
                            	if (isset($_SESSION['userID']))
                            	{
                                $identificador = $_SESSION['userID']."-".$d.$m."-".$_SESSION['Key'];
                            	echo "<br>";
                            	$consulta = "select*from productos where Disponibilidad = 'si'";
							    $resultado = $mysqli->query($consulta);

							   

                                //Contador:
                                $cont = 0;

                                //Monto total:
                                $montoT = 0;


				           	while ($filas = mysqli_fetch_assoc($resultado))
     				         {
     				         	

                                //Busqueda de nombre de textbox
     				         	$cadenaName = "tb".$filas['IDproducto'];

     				         	//Cantidad de producto
     				         	$cantidad = $_POST[$cadenaName];

     				         	if($cantidad != "")
     				         	{
     				         		if ($cont == 0) {
     				         		echo '<div class="card text-center border"';
     				         		echo"<h2>Resumen de pedido</h2>";
     				         		echo '</div>';
     				         		}
     				         		//Asignación de ID de pedido:
     				         	$consultaUltReg = 'select * from pedido order by IDpedido desc limit 1';
     				         	$Ult = $mysqli->query($consultaUltReg);
     				         	$UltId = mysqli_fetch_assoc($Ult);
     				         	$ID = $UltId['IDpedido'] + 1;


     				         		$MatPedidos[$cont]['IDped'] = $ID; 
     				         		$MatPedidos[$cont]['Identificador'] = $identificador; 
     				         		$MatPedidos[$cont]['IDproducto'] = $filas['IDproducto']; 
     				         		$MatPedidos[$cont]['IDcliente'] = $_SESSION['userID']; 
     				         		$MatPedidos[$cont]['Fecha'] = $fecha; 
     				         		$MatPedidos[$cont]['Cantidad'] = $cantidad; 
     				         		$MatPedidos[$cont]['Monto'] = $cantidad*$filas['Precio']; 

     				         		$cadenaInsert = "insert into pedido values (".$MatPedidos[$cont]['IDped'].",'".$MatPedidos[$cont]['Identificador']."',".$MatPedidos[$cont]['IDproducto'].",".$MatPedidos[$cont]['IDcliente'].",'".$MatPedidos[$cont]['Fecha']."',".$MatPedidos[$cont]['Cantidad'].",".$MatPedidos[$cont]['Monto'].", 'activo');";
     				                $guardarPedido = $mysqli ->query($cadenaInsert); 



     				         		echo '<div class="card text-center border"';
     				         		echo"<p>".$filas['Nombre']."</p>";
     				         		echo"<p>Cantidad: ".$cantidad." &nbsp; &nbsp; &nbsp; &nbsp; Monto: $".($cantidad*$filas['Precio'])."</p>";
     				         		echo '</div>';

     				         		$cont = $cont + 1;
     				         		$montoT += $cantidad*$filas['Precio'];

     				         	}
				             } 
				                    if ($montoT>0) {
				                    echo '<div class="card text-center border"';
				                    echo"<p>Monto total a cancelar: $". $montoT."</p>";
     				         		echo '</div>';
     				         		echo "<br>";
				                    echo '<script type="text/javascript">document.getElementById("realizarP").style.display = "none";</script>';
				                    echo '<form  method = "post">';
				                     echo '<script type="text/javascript">document.getElementById("titulo").innerHTML = "Desplácese hacia abajo para confirmar su pedido";</script>';
				                    echo '<input type="submit" name="Confirmar" id = "confb" class="genric-btn primary circle"  value = "Confirmar pedido" style="float:right; ">';
     				         	    echo '<input type="submit" name="Cancelar" id = "cancb" class="genric-btn primary circle"  value = "Cancelar pedido" style="float:right; ">';
     				         	    echo '</form>';
				                    }
     				         		
               }
               else 
               {
                  echo '<script type="text/javascript">document.getElementById("titulo").innerHTML = "Por favor inicie sesión para realizar pedidos.";</script>';
               }
     	}


                            if (isset($_POST['Cancelar'])) {
                            $identificador = $_SESSION['userID']."-".$d.$m."-".$_SESSION['Key'];
                            $cadenaDelete = "delete from pedido where IdentificadorDePedido='".$identificador."'";
     				   	    $guardarPedido = $mysqli ->query($cadenaDelete); 
     				   	     echo '<script type="text/javascript">document.getElementById("confb").style.display = "none";</script>';
				             echo '<script type="text/javascript">document.getElementById("cancb").style.display = "none";</script>';

				             echo '<script type="text/javascript">document.getElementById("titulo").innerHTML = "Pedido cancelado. Realizar otro pedido:";</script>';

				             $_SESSION['Key'] = $_SESSION['Key'] + 1;


     				   }

     				   if (isset($_POST['Confirmar'])) {
     				   	echo '<script type="text/javascript">document.getElementById("confb").style.display = "none";</script>';
				        echo '<script type="text/javascript">document.getElementById("cancb").style.display = "none";</script>';

				           echo '<script type="text/javascript">document.getElementById("titulo").innerHTML = "Pedido realizado. Realizar otro pedido:";</script>';

				           	 $_SESSION['Key'] = $_SESSION['Key'] + 1;


     				   }


     				  ?>

     				   

				</div>					
			</section>

			<!-- End pedidos-->
													
				
			<!-- start footer Area -->		
			<footer class="footer-area">
				<div class="container">
					<div class="row pt-120 pb-80">
						<div class="col-lg-4 col-md-6">
							<div class="single-footer-widget">
								<h6>Sobre nosotros</h6>
								<p>
									The Monkey Cakes, es una pastelería y repostería, especializada en Cup Cakes de banano, de ahí proviene el nombre "Monkey". También hacemos brownies, magdalenas,quesadillas especiales, por encargo.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="single-footer-widget">
								<h6>Links útiles</h6>
								<div class="row">
									<ul class="col footer-nav">
										<li><a href="#">Home</a></li>
										<li><a href="#">Conócenos</a></li>
										<li><a href="#">Reposteria</a></li>
										<li><a href="#">Redes sociales</a></li>
									</ul>
									<ul class="col footer-nav">
										<li><a href="#">Contáctame</a></li>
										<li><a href="#">Únetenos</a></li>
									</ul>									
								</div>
							</div>
						</div>						
						<div class="col-lg-4  col-md-6">
							<div class="single-footer-widget mail-chimp">
								<h6 class="mb-20">Contáctanos</h6>
								<ul class="list-contact">
									<li class="flex-row d-flex">
										<div class="icon">
											<span class="lnr lnr-home"></span>
										</div>
										<div class="detail">
											<h4>San Salvador, El Salvador</h4>
											<p>
												Mejicanos
											</p>
										</div>	
									</li>
									<li class="flex-row d-flex">
										<div class="icon">
											<span class="lnr lnr-phone-handset"></span>
										</div>
										<div class="detail">
											<h4>+(503) 7455 5848</h4>
											<p>
												Siempre abierto
											</p>
										</div>	
									</li>
									<li class="flex-row d-flex">
										<div class="icon">
											<span class="lnr lnr-envelope"></span>
										</div>
										<div class="detail">
											<h4>romeroguerra.monica@gmail.com</h4>
											<p>
												Contáctame para nuevos pedidos!
											</p>
										</div>	
									</li>																		
								</ul>
							</div>
						</div>						
					</div>
				</div>
				<div class="copyright-text">
					<div class="container">
						<div class="row footer-bottom d-flex justify-content-between">
							<p class="col-lg-8 col-sm-6 footer-text m-0 text-white">
							Copyright &copy; 2020 All rights reserved.</p>
							<div class="col-lg-4 col-sm-6 footer-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
							</div>
						</div>						
					</div>
				</div>
			</footer>
			<!-- End footer Area -->	

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>						
			<script src="js/jquery.nice-select.min.js"></script>							
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
	</html>