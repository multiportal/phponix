<?php include '../../admin/conexion.php';?>
<?php 
$tema='default';
$nombre_fichero = './images/cover.jpg';
if(file_exists($nombre_fichero)){
	$cover=$page_url.$path_t.$tema.'/images/cover.jpg';
}else{
	$cover=$page_url.$path_t.'default/images/nocover.jpg';
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $page_url;?>assets/css/style.css" />
<style>
h1,h2,h3,h4,h5,h6{margin:5px 0 0 0;}
</style>
</head>
<body>
<div class="row">

<div id="ficha_tema">
	<div id="cover">
    	<img src="<?php echo $cover;?>" width="90%">
	</div>
    <div id="detalles">
		<div>
    		<h2>PHP-Onix</h2>
    	</div>
		<div>
    		<h3>Version:</h3>
    		<div>1.0.12</div>
    	</div>
		<div>
    		<h3>Fecha:</h3>
    		<div>21/09/2017</div>
    	</div>
		<div>
    		<h3>Autor:</h3>
    		<div>Guillermo Jim&eacute;nez L&oacute;pez</div>
    	</div>
		<div>
    		<h3>Descripci&oacute;n:</h3>
    		<div>Desarrollo de PHPonix un CMS sencillo y practico.</div>
    	</div>
	</div>
</div>

</div>
</body>
</html>