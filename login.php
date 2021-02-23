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
				           if (isset($_COOKIE['userID'])) {
				           	if($_COOKIE['userID']!="No")
				           	{
				           	 $_SESSION['userID'] = $_COOKIE['userID'];
                             $_SESSION['Tipo'] = $_COOKIE['Tipo'];
                             $_SESSION['Key'] = $_COOKIE['Key'];
                            }
				           }
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
				          	if(isset($_SESSION['userID']))
				           {
				          echo '<form method = post>';
				          echo '<input type="submit"   name="closeSes" value = "Cerrar sesión" style="float:left;"></input>';
				          echo '</form>';
				           }

				           if (isset($_POST['closeSes'])) {
				           	session_unset();
	                        session_destroy();
	                                                    setcookie("userID","No",time() + (86400 * 30), "/");

                            unset($_COOKIE['userID']);
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
							<h1 class="text-white">
								Inicia Sesión		
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="login.php"> Inicia Sesión</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->				  

			<!-- Start contact-page Area -->
			<section class="contact-page-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 d-flex flex-column address-wrap">
							<div class="single-contact-address d-flex flex-row">
								<div class="icon">
									<span class="lnr lnr-coffee-cup"></span>
								</div>
								<div class="contact-details">
									<h5>Inicia sesión</h5>
									<p>Con tu cuenta ya iniciada, <br>podrás acceder al catálogo de productos, en el cual ahora, <br>podras hacer pedidos!</p>
									<?php 
							        if (isset($_POST['iniciar'])) {

							        	//Recolección de datos

							        	$datos['pass'] = $_POST['password'];
							        	$datos['email'] = $_POST['email'];
							         

							            //Conexión:
							            include_once('class/conn.php');

							            $conex = new conexion();

							            $mysqli = $conex->cone;


							           //$mysqli = new mysqli('localhost', 'usuario', '3112', 'monkeycake');
                                       $mysqli -> set_charset("utf8");

                                       $ProcederConLog = 0;
                                       $mensaje = 'Credenciales inválidas. Intente nuevamente.';

                                       $consultaReg = 'select * from clientes order by IDcliente desc';
                                       $Resultado = $mysqli->query($consultaReg);

                                       while ($filas = mysqli_fetch_assoc($Resultado)) {

                                       	if($filas['Email'] == $datos['email'] && $filas['Password'] == $datos['pass'])
                                       	{
                                       		$ProcederConLog = 1;
                                       	}
                                       }

                     


                                       if($ProcederConLog == 1)
                                       {
                                        $consultaDatos= "select * from  clientes where Email = '".$datos['email']."'";
                                        $realizarCons = $mysqli ->query($consultaDatos); 
                                        $GuardarInf = mysqli_fetch_assoc($realizarCons);

                                        $datos['nombre']=$GuardarInf['Nombre'];
                                        $datos['apellido']=$GuardarInf['Apellido'];
                                        $datos['direc']=$GuardarInf['Direccion'];
                                        $datos['tel']=$GuardarInf['Telefono'];
                                        $datos['id']=$GuardarInf['IDcliente'];
                                        $datos['tipo']=$GuardarInf['Tipo'];

                                        if ($GuardarInf['Estado'] == "activo") {
                                        	$mensaje = 'Sesión iniciada como '.$datos['nombre']." ".$datos['apellido'];

                                        $_SESSION['userID'] = $datos['id'];
                                        $_SESSION['Tipo'] = $datos['tipo'];
                                        $_SESSION['Key'] = rand(1,99);

                                 
                                        setcookie("userID",$_SESSION['userID'],time() + (86400 * 30), "/");
                                        setcookie("Tipo",$_SESSION['Tipo'],time() + (86400 * 30), "/");
                                        setcookie("Key",$_SESSION['Key'],time() + (86400 * 30), "/");


                                        header('Location: /Panaderia/index.php');
                                        }

                                        else
                                        {
                                        $mensaje = "Tu cuenta ha sido desactivada.";
                                        }


                                                                      }

                                        echo "<p>".$mensaje."</p>";    
                                     }
							     ?>	

								</div>
							</div>
																				
						</div>
						<div class="col-lg-8">
							<form class="form-area" method="post" class="contact-form text-right">
								<div class="row">	
									<div class="col-lg-6 form-group">

										<input name="email" placeholder="Introduce tu email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Introduce tu email'" class="common-input mb-20 form-control" required="" type="email">

										<input name="password" placeholder="Introduce tu contraseña" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Introduce tu contraseña'" class="common-input mb-20 form-control" required="" type="password">

										<input type="submit" name="iniciar" class="genric-btn primary circle" name="in" value = "Iniciar sesión" style="float:left;">	</input>

									</div>
								</div>
							</form>	
						</div>
					</div>
				</div>	
			</section>
			<!-- End contact-page Area -->

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