<?php
include 'admin/functions.php';
sql_opciones('slide_active',$valor);
$slide=$valor;
?>
<?php if($slide==1){?>
<div id="banner1" style="background:url(<?php echo $page_url;?>modulos/Home/img/home.jpg); background-repeat:no-repeat; background-position:center;">
	<div id="slider-content">
    	<div class="txt-c1"><span style="color:#36C;">Administrar</span> tu negocio</div>
    	<div class="txt-c2">nunca fue tan <span style="color:#36C;">f&aacute;cil</span></div>
        <div class="txt-c3"><b>PhpOnix</b> la soluci&oacute;n completa y moderna, sin complicaciones.</div>
    </div>
</div>
<?php }?>
<?php
pages($mod,$ext,$contenido,$activo);
if($activo==1){
	echo $contenido;
}else{
?>
	<div id="content1">
    	<div id="intro">
		<div class="clear"></div>
        <h2>PHP Onix el mejor CMS para crear y administrar tu sitio web.</h2>
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
	<div id="content2">
    	<div id="beneficios">
        <div class="clear"></div>
        <h2>Beneficios</h2>
		<div class="clear"></div>
        <p></p>
		<div class="clear"></div>
        <div class="col-md-4 col-sm-6 col-xs-12" style="text-align:center;">
        <h3>Multi-Dispositivos</h3>
        <img src="<?php echo $page_url;?>modulos/Home/img/multidispositivo.png" width="80%">
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" style="text-align:center;">
        <h3>Reporte de Estadisticas</h3>
        <img src="<?php echo $page_url;?>modulos/Home/img/estadisticas.png" width="80%">
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" style="text-align:center;">
        <h3>Gestion de Contenido</h3>
        <img src="<?php echo $page_url;?>modulos/Home/img/busqueda-sistema.png" width="80%">
        </div>

        </div>
	</div>
<?php
}
?>
