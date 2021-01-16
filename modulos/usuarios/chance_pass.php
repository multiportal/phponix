<?php
//$username=$_SESSION['username'];

if(isset($_POST['pass'])){
	include '../../admin/conexion.php';
	$username=(isset($_POST['username']))?$_POST['username']:'';
	$new_pass=(isset($_POST['pass']))?$_POST['pass']:'';
	/* Encriptamos "Ciframos" el password */
	$pass1=sha1(md5($new_pass));
	$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."signup SET password='".$pass1."', actualizacion='".$username."2019x".$new_pass."' WHERE username='".$username."';") or print mysqli_error($mysqli);
	open_page_form();
	if($save){
		//$URL_log=($mode=='page') ? $page_url.'index.php?mod=usuarios' : $page_url.'index.php';
		$URL_log=$page_url.'admin/';
		recargar($seg=3,$URL_log,$target);
		echo '
		<div class="container">
		<header>
			<div><img id="logo-s" src="'.$page_url.$path_tema.'images/logo.min.png" alt="logo" title="logo" /></div>
			<h2 style="color:#0f0;">Su password ha sido cambiado.</h2>
			<div class="support-note">
				<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
			</div>
		</header>';
		//$username=$_SESSION['username'];
		$mod='pass_change_ok';
		log_visitas($username);
	}else{
		$URL_log=$page_url.'admin/';
		recargar($seg=3,$URL_log,$target);
		echo '
		<div class="container">
		<header>
			<div><img id="logo-s" src="'.$page_url.$path_tema.'images/logo.min.png" alt="logo" title="logo" /></div>
			<h2 style="color:#f00;">Ocurrio un error al cambiar la contraseña. Intentelo m&aacute;s tarde.</h2>
			<div class="support-note">
				<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
			</div>
		</header>';
		$mod='pass_change_error';
		log_visitas($username);
	}
	close_page();
}

if(isset($_SESSION["username"]) && ($pass=='123456' || $password=='123456')){
$URL=$page_url.'modulos/usuarios/chance_pass.php';
$ID=$_SESSION['ID'];	
$username=$_SESSION["username"];
echo '
<div class="container">
	<header>
		<div><img id="logo-s" src="'.$page_url.$path_tema.'images/logo.min.png" alt="logo" title="logo" /></div>
		<h2>Antes de continuar cambie su contrase&ntilde;a por favor...</h2>
		<div class="support-note">
		<span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
		</div>
	</header>
	<section class="main">
		<form name="form1" class="form-4" method="POST" action="'.$URL.'">
	    <p>
	        <label for="pass">Password</label>
	        <input type="password" id="pass" name="pass" placeholder="Password" required>
			<input type="hidden" id="username" name="username" value="'.$username.'" required autocomplete="off"> 
	    </p>
	    <p>
	        <input type="submit" name="cambiar" value="Cambiar">
	    </p>       
		</form>
	</section>
</div>';
	$mod='pass_change';
	log_visitas($username);
}
?>