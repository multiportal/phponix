<?php 
if(!isset($_SESSION["username"])){
	$u='Iniciar Sesi&oacute;n';
}else{
	$u=$username;//$salir=' | <a href="'.$page_url.'modulos/usuarios/logout.php?id='.$ID_login.'" title="Salir"><i class="fa fa-power-off"></i></a>';
}

if($nivel_login==-1){    
    $das='<a href="'.$page_url.'index.php?mod=dashboard" title=""><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>';
}else{$das='';}
?>
<?php 
if($mod=='gmaps'){
?>
<link href="<?php echo $page_url;?>assets/plugins/sidebar/sidebar.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $page_url;?>assets/plugins/sidebar/sidebar.js" type="text/javascript"></script>

<div id="div-sesion">
	<nav class="topnav">
		<a href="#" onclick="openNav();">                
        	<img class="img-circle" src="<?php echo $page_url;?>assets/plugins/sesion/img/unknown_user.png" width="30" height="30">&nbsp;&nbsp;
			<span><?php echo $u;?></span>
		</a>
	</nav>
</div>

<div id="sideNavigation" class="sidenav">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	<?php echo $das;?>    
    <a href="<?php echo $page_url;?>index.php?mod=usuarios" title=""><i class="fa fa-user"></i> <span>Mi Perfil</span></a>
    <a href="<?php echo $page_url.'modulos/usuarios/logout.php?id='.$ID_login;?>" title=""><i class="fa fa-power-off"></i> <span>Salir</span></a>
 </div>
<?php }?>