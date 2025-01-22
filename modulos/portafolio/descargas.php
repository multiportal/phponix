<?php
include 'admin/functions.php';
//page($mod,$ext,$activo);
if($activo==1){echo $contenido;}else{
?>
	<div id="content1">
    	<div id="intro">
		<div class="clear"></div>
        <h2>Descargas</h2>
        <div class="clear"></div>
        <p style="font-size:16px;">Con <b>PHPOnix</b> podras instalar y crear tu sitio web en 5 minutos ademas con herramientas para gestionar, monitoriar y posicionar tu p&aacute;gina web. <b>PHPOnix</b> cuenta con multiples funcionalidades desde crear un p&aacute;gina <b>web standar</b>, <b>landingpage</b>, <b>intranet</b>, <b>blog</b>, <b>catalogo</b>, <b>portafolio</b>, incluso una tienda virtual*(<b>ecommerce</b>) para tu negocio o servicio tu elijes la funcionalidad.</p>
		<div class="clear"></div>
        <div class="col-md-4 col-sm-6 col-xs-12" style="text-align:center;">
        <h3>Sitio Web</h3>
        <img src="<?php echo $page_url;?>modulos/Home/img/web.png" width="80%">
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" style="text-align:center;">
        <h3>LandingPage</h3>
        <img src="<?php echo $page_url;?>modulos/Home/img/intuitivo.png" width="80%">
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" style="text-align:center;">
        <h3>Ecommerce</h3>
        <img src="<?php echo $page_url;?>modulos/Home/img/ecommerce.png" width="80%">
        </div>
        </div>
    </div>

<?php }?>
