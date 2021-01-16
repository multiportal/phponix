<?php
include 'admin/functions.php';
pages($mod,$ext,$contenido,$activo);
if($activo==1){echo $contenido;}else{
?>
	<div id="content1">
    	<div id="intro">
			<div class="clear"></div>
        	<h2>Nosotros</h2>
        	<div class="clear"></div>
        	<p style="font-size:16px;">Muliportal es una empresa dedicada al marketing digital y el desarrollo de p&aacute;ginas Web. PHP Onix es una un CMS desarrollado en PHP y creado para la gesti&oacute;n y administraci&oacute;n de sitios web de una forma r&aacute;pida y eficaz, constituido por una serie de modulos perfectamente adaptables para los requerimientos de tu sitio web. Este producto es desarrollado por <a target="_blank" href="https:multiportal.webcindario.com">[:Multiportal:]</a></p>
			<div class="clear"></div>
        	<div class="col-xs-12" style="text-align:center;">
        		<h3>PHPONIX</h3>
        		<img src="<?php echo $page_url.$path_tema;?>images/logo.png" width="280">
        	</div>
        </div>
    </div>

<?php }?>
