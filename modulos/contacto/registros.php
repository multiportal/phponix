<?php
$id=$_GET['id'];
if($id!=''){
	$sql=mysqli_query($mysqli,"UPDATE ".$DBprefix."opciones SET valor={$id} WHERE nom='email_test'");
	$sql1=mysqli_query($mysqli,"SELECT url FROM ".$DBprefix."menu_web WHERE modulo='{$mod}'");	
	if($row=mysqli_fetch_array($sql1)){$url1=$row['url'];}
	sql_opciones('link_var',$valor);
	$URL=($valor==1)?$page_url.'index.php?mod=contacto':$page_url.$url1;	
	recargar(1,$URL,$target);		
}

sql_opciones('email_test',$valor);
$act_prueba=($valor==1)?'<a href="'.$page_url.'index.php?mod=contacto&id=0" style="color:#f00;">Desactivar Prueba</a>':'<a href="'.$page_url.'index.php?mod=contacto&id=1" style="color:#0ff;">Activar Prueba</a>';

if($nivel_login==-1 && $username=='admin'){
	email_forms($CoR1,$CoE1,$BCC1);	
	$aviso.= '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-info"></i> Info</h4>
				['.$act_prueba.'] [<a href="index.php?mod='.$mod.'&ext=admin/index"><i class="fa fa-gear"></i> Config. Contacto</a>] [<a href="'.$page_url.'index.php?mod='.$mod.'&ext=admin/index&opc=forms"><i class="fa fa-pencil-square-o"></i> Correos de Formulario</a>]<br>
                Email Recepci&oacute;n: '.$CoR1.' | '.$BCC1.' <br>
				Email Envio: '.$CoE1.'				
          </div>';
}
?>
<div><?php echo $aviso;?></div>
<!-- form message -->
<div class="row">
	<div class="col-12">
    	<div class="alert alert-success contact__msg" style="display:none;" role="alert">
        	Tu mensaje fue enviado exitosamente.
		</div>
	</div>
</div>
<!-- end message -->
                <form class="contact__form" method="post" action="<?php echo $page_url;?>modulos/contacto/form/mail.php">    
					<div class="row foot-lft">
						<div class="col-md-6 wthree_contact_left_grid">
							<input type="text" id="nombre" name="nombre" placeholder="Name" required autocomplete="off">
							<input type="email" id="email" name="email" placeholder="Email" required autocomplete="off">
							<input type="tel" id="tel" name="tel" placeholder="Telephone" required autocomplete="off">
							<input type="text" id="asunto" name="asunto" placeholder="Subject" required autocomplete="off">
						</div>
						<div class="col-md-6 wthree_contact_left_grid">
							<textarea id="msj" name="msj" placeholder="Message..." required></textarea>
							<button type="submit" >Enviar</button>
						</div>
					</div>
				</form>                  
<script src="<?php echo $page_url.'modulos/contacto/form/form.js';?>"></script>