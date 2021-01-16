<?php
include '../../admin/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Login</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="ebook" />
        <link rel="shortcut icon" href="favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="<?php echo $page_url;?>css/bg_sesion.css" />
		<script src="style/js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>	
			@import url(http://fonts.googleapis.com/css?family=Raleway:400,700);
			body {
				background: #7f9b4e url(<?php echo $page_url.'temas/ebook/img/bg/bg1.jpg';?>) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
    </head>
    <base target="_parent">
    <body>
        <div class="container">
		
			<!-- Codrops top bar --><!--/ Codrops top bar -->
			
			<header>
			
				<h1>Ingrese a su cuenta</h1>
				<h2>No tiene una cuenta registrese <a href="registro.html">aqu&iacute;</a>.</h2>
				<div class="support-note">
					<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
				</div>
				
			</header>
			
			<section class="main">
				<form class="form-4" action="comprueba.php" method="POST">
				    <h1>Login o Registro</h1>
				    <p>
				        <label for="login">Nick o email</label>
				        <input type="text" name="login" placeholder="Nick o email" required>
				    </p>
				    <p>
				        <label for="password">Password</label>
				        <input type="password" name='pass' placeholder="Password" required> 
				    </p>

				    <p>
				        <input type="submit" name="submit" value="Aceptar">
				    </p>       
				</form>
			</section>
			
        </div>
    </body>
</html>
<?php 
?>