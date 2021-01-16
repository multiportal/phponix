<?php 
if(isset($_SESSION["username"])){
//	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
	include 'admin/functions.php';
?>
<style>
.box-title{text-transform:capitalize;}
.mailbox-name{font-size:13px;}
.mailbox-subject,.mailbox-date{font-size:12px;}
.mailbox-subject a{color:#111;}
</style>
<script type="text/javascript">
    function confirm1(id,tabla,carpeta){
    var r=confirm("Realmente desea eliminar este correo "+id+" ("+tabla+")?.");
    if(r==true){
	<?php
	print " window.location.href='{$URL}&table='+tabla+'&lista='+carpeta+'&id='+id+'&delete=1'; ";
	if($_GET['delete']==1 && !empty($_GET['delete'])){
		//mysqli_query($mysqli,"DELETE FROM ".$DBprefix.$tabla." WHERE id='".$_GET['id']."';") or print mysqli_error($mysqli);
		$id=$_GET['id'];$tabla=$_GET['table'];$lista=$_GET['lista'];
		$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tabla." WHERE ID='{$id}';") or print mysqli_error($mysqli); 
		if($row=mysqli_fetch_array($sql)){$m_fecha=$row['fecha'];}
		mysqli_query($mysqli,"UPDATE ".$DBprefix.$tabla." SET cat_list='{$lista}',fecha='{$m_fecha}' WHERE ID='{$id}';") or print mysqli_error($mysqli);	}
	?>}
    }
</script>  
<?php 
if($_GET['delete']==1 && !empty($_GET['delete'])){
	$ext1=($ext!=''&&$ext!='index')?'&ext='.$ext:'';
	$opc1=($opc!=''&&$opc!='read_msg')?'&opc='.$opc:'';
	$URL1=$page_url.'index.php?mod='.$mod.$ext1.$opc1;
	recargar(1,$URL1,$target);
}
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $nombre_mod;?>
        <small><?php echo $description_mod;?></small>
      </h1>
      <?php menu_rutas();?>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="row">
        <div class="col-md-3">
			<?php mail_bar();?>
        </div><!-- /.col -->
<?php 
switch(true){
	case($opc=='config'):

	break;
	case($opc=='send_msg'):
//RESPONDER-REENVIAR
$origen=$_GET['origen'];
//EDITAR BORRADOR
$id=$_GET['id'];
$folder=$_GET['folder'];
$tabla=$_GET['table'];

if($id!=''){
 $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tabla." WHERE ID='{$id}';") or print mysqli_error($mysqli); 
 while($row=mysqli_fetch_array($sql)){
	$email=$row['email'];
	$subject=$row['asunto'];
	$msj=$row['msj'];
	$fecha=$row['fecha'];
	$adjuntos=$row['adjuntos'];
 }
}
if($origen!=''){
	$msj="\r\n"."\r\n"."\r\n".'
	----------------------- '.$origen.' -------------------------
	'."\r\n".$msj;
}
if($origen=='reenviar'){
	$email='';
}
//BORRADOR
$enviar=(isset($_POST['enviar']))?1:0;//1=enviados - 0=borradores
//ENVIAR	
if(isset($_POST['enviar']) || isset($_POST['aceptar'])){
//sql_opciones('email_test',$valor);
//$email_test=$valor;	
	//$nom=$_POST['nom'];
	//$ape=$_POST['ape'];
	//$nombre=$nom.' '.$ape;
	//$tel=$_POST['tel'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$msj=$_POST['compose-textarea'];
	//$nombre = htmlentities($nombre, ENT_COMPAT,'ISO-8859-1', true);
	//$nombre = htmlentities($nombre);
	
	html_iso($nombre,$email,$subject,$msj);    
	if($email=='' && $subject=='' && $msj==''){
        $error = " <b>Los campos estan vacios.</b>\n\r"; $c++;
    }
	if($email!='' || $subject!='' || $msj!=''){
       	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ $error .= "<br>  *Ingrese una direcci&oacute;n de correo v&aacute;lida.\n\r"; $c++; }
	}
	if($email!='' && $subject!='' && $msj!=''){        
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ $error .= "<br>  *Ingrese una direcci&oacute;n de correo v&aacute;lida.\n\r"; $c++; }
   	}
	if($email==''){$error.='<br> *Falta Correo'; $c++;}
	if($subject==''){$error.='<br> *Falta Asunto'; $c++;}
	if($msj==''){$error.='<br> *Falta Mensaje'; $c++;}

	if($c > 0){
        $aviso='
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>'.$error.'
            </div>
            ';
    }else{

			$cat_list=($enviar!=1)?'borradores':'enviados';
			$sec='registros';
			$para=$email;
			$de=$webMail;
			$nombre=($enviar!=1)?'Borradores -':'Envios -';
			$titulo=($enviar!=1)?$subject:'WEB '.$page_name.'('.$subject.')';
			$message = "<html><body style='font-family:Verdana, Geneva, sans-serif; font-size: 13px;'>".
						"<p>Mensaje enviado a tráves de la página web Contacto de {$page_name}.</p>".
						"<table style='font-family:Verdana, Geneva, sans-serif; font-size:13px;'>";
    		//$message .= "<tr><td align='right' style='background-color: #fff;'>Usuario:</td><td style='background-color: #fff;'>".$nombre."</td></tr>";
    		//$message .= "<tr><td align='right' style='background-color: #eee;'>Tel:</td><td style='background-color: #eee;'>".$tel."</td></tr>";
    		//$message .= "<tr><td align='right' style='background-color: #fff;'>Correo:</td><td style='background-color: #fff;'>".$email."</td></tr>";
    		//$message .= "<tr><td align='right' style='background-color: #eee;'>Asunto:</td><td style='background-color: #eee;'>".$subject."</td></tr>";
    		$message .= "<tr><td align='right' style='background-color: #fff;'>Mensaje:</td><td style='background-color: #fff;'>".$msj."</td></tr>";
    		$message .="</table></body></html>";
			$header = "From: WEB ".$page_name."" . "<{$CoE}/>\r\n";
  			$header .= 'MIME-Version: 1.0' . "\r\n";
    		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";		 

			$avi=($enviar!=1)?'Su mensaje ha sido guardado en borrador':'Su mensaje ha sido enviado a '.$para.' gracias ';

			if($id!='' && $origen==''){
				$save=mysqli_query($mysqli,"UPDATE ".$DBprefix."registros SET nombre='{$nombre}', email='{$para}', asunto='{$titulo}', msj='{$msj}', cat_list='{$cat_list}', adjuntos='{$adjuntos}', visto=0, fecha='{$fecha}' WHERE ID='{$id}';") or print mysqli_error($mysqli); 
			}
			else{
				$save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."registros (ip,nombre,email,tel,asunto,msj,cat_list,seccion,visible) VALUES ('{$ip}','{$nombre}','{$email}','{$tel}','{$titulo}','{$msj}','{$cat_list}','{$sec}','1');") or print mysqli_error($mysqli); 
			}
			validar_aviso($save,$avi,'Hubo un problema al enviar su email, por favor intentelo nuevamente',$aviso);
			if($enviar==1){
				mail($para,$titulo,$message,$header);
			}
	}
}
?>

		<div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Redactar Nuevo Mensaje</h3>
            </div>
            <!-- /.box-header -->
<div><?php echo $aviso;?></div>
            <form name="form1" method="POST" enctype="multipart/form-data" action="<?php echo $URL;?>">
            <div class="box-body">
              <div class="form-group">
                <input class="form-control" name="email" id="email" placeholder="Para:" value="<?php echo $email;?>">
              </div>
              <div class="form-group">
                <input class="form-control" name="subject" id="subject" placeholder="Asunto:" value="<?php echo $subject;?>">
              </div>
              <div class="form-group">
                <textarea name="compose-textarea" id="compose-textarea" class="form-control" style="height: 300px"><?php echo $msj;?></textarea>
              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Adjuntos 
                  <input type="file" name="attachment" disabled> 
                </div>
                <p class="help-block">Max. 10MB <span style="color:#C00;">*Deshabilitado</span></p>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" name="aceptar" id="aceptar" class="btn btn-default"><i class="fa fa-pencil"></i> Borrador</button>
                <button type="submit" name="enviar" id="enviar" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
              </div>
              <button type="reset" class="btn btn-default" onClick="javascript:document.location.href='<?php echo $page_url.'index.php?mod='.$mod;?>';"><i class="fa fa-times"></i> Descartar</button>
            </div>
            <!-- /.box-footer -->
			</form>
          </div>
          <!-- /. box -->
		</div>       
<?php
	break;
	case($opc=='replay'):
?>

<?php
	break;
	case($opc=='reenviar'):
?>

<?php
	break;
	case($opc=='read_msg' && !empty($_GET['id'])):
$id=$_GET['id'];
$sec=$_GET['sec'];
 if($sec!='contacto'){
	$tabla='registros'; 
 }else{
	$tabla='contacto'; 
 }
$sql=mysqli_query($mysqli,"SELECT * FROM `".$DBprefix.$tabla."` WHERE ID='{$id}';") or print mysqli_error($mysqli); 
$num_rows=mysqli_num_rows($sql);
if($row=mysqli_fetch_array($sql)){
//$m_id=$row['ID'];
$m_para=$row['para'];
$m_ip=$row['ip'];
$m_nombre=$row['nombre'];
$m_email=$row['email'];
$m_tel=$row['tel'];
$m_asunto=$row['asunto'];
$m_msj=$row['msj'];
$m_fecha=$row['fecha'];
$m_cat_list=$row['cat_list'];
$m_seccion=$row['seccion'];
$m_tabla=$row['tabla'];
$m_adjuntos=$row['adjuntos'];
$m_visto=$row['visto'];
$m_visble=$row['visible'];
}
html_iso_mailbox($m_nombre,$m_asunto);
$sql=mysqli_query($mysqli,"UPDATE `".$DBprefix.$tabla."` SET visto='1',fecha='{$m_fecha}' WHERE ID='{$id}';") or print mysqli_error($mysqli);
?>
<script>
function mostrarm(val){
	switch (val){
	case 1:
		document.getElementById('d_msg').innerHTML = '<a href="javascript:mostrarm(0);">Ver menos</a><div><b>IP:</b> <?php echo $m_ip;?></div><div><b>Buzon:</b> <?php echo $m_cat_list;?></div><div><b>Seccion:</b> <?php echo $m_seccion;?></div>';
	break; 
	default: 
		document.getElementById('d_msg').innerHTML = '<a href="javascript:mostrarm(1);">Ver m&aacute;s</a>';
	break;
	}
}
</script>
		<div id="imprimir_email" class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mail <?php echo $m_cat_list;?></h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo $m_asunto;?></h3>
                <h5>Para: <?php echo $m_para;?></h5>
                <h5>De: <?php echo $m_nombre.' &lt;'.$m_email.'&gt;';?> <?php if($m_tel!=''){echo ' - Tel:'.$m_tel;}?>
                <span class="mailbox-read-time pull-right"><?php echo $m_fecha;?></span></h5>
                <div>
                  <div id="d_msg"><a href="javascript:mostrarm(1);">Ver m&aacute;s</a></div>
                </div>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Papelera" onClick="confirm1(<?php echo $id;?>,'<?php echo $m_seccion;?>','papelera')">
                    <i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Responder" onClick="javascript:document.location.href='<?php echo $page_url.'index.php?mod='.$mod.'&opc=send_msg&id='.$id.'&folder='.$m_cat_list.'&table='.$m_tabla.'&origen=responder';?>';">
                    <i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reenviar" onClick="javascript:document.location.href='<?php echo $page_url.'index.php?mod='.$mod.'&opc=send_msg&id='.$id.'&folder='.$m_cat_list.'&table='.$m_tabla.'&origen=reenviar';?>';">
                    <i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button id="btnImprimir" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Imprimir"><i class="fa fa-print"></i></button>
<?php 
if($m_cat_list=='borradores'){
?>
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Editar y Enviar" onClick="javascript:document.location.href='<?php echo $page_url.'index.php?mod='.$mod.'&opc=send_msg&id='.$id.'&folder='.$m_cat_list.'&table='.$m_seccion;?>';"><i class="fa fa-paper-plane-o"></i></button>
<?php }?>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
              <p><?php echo $m_msj;?></p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <ul class="mailbox-attachments clearfix">
              	<?php echo $m_adjuntos;?>
                <!--
                <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Sep2014-report.pdf</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> App Description.docx</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                <li>
                  <span class="mailbox-attachment-icon has-img"><img src="<?php echo $page_url.$path_LTE;?>dist/img/photo1.png" alt="Attachment"></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo1.png</a>
                        <span class="mailbox-attachment-size">
                          2.67 MB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                <li>
                  <span class="mailbox-attachment-icon has-img"><img src="<?php echo $page_url.$path_LTE;?>dist/img/photo2.png" alt="Attachment"></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo2.png</a>
                        <span class="mailbox-attachment-size">
                          1.9 MB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                -->
              </ul>
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default" onClick="javascript:document.location.href='<?php echo $page_url.'index.php?mod='.$mod.'&opc=send_msg&id='.$id.'&folder='.$m_cat_list.'&table='.$m_tabla.'&origen=responder';?>';"><i class="fa fa-reply"></i> Responder</button>
                <button type="button" class="btn btn-default" onClick="javascript:document.location.href='<?php echo $page_url.'index.php?mod='.$mod.'&opc=send_msg&id='.$id.'&folder='.$m_cat_list.'&table='.$m_tabla.'&origen=reenviar';?>';"><i class="fa fa-share"></i> Reenviar</button>
              </div>
              <button type="button" class="btn btn-default" onClick="confirm1(<?php echo $id;?>,'<?php echo $m_seccion;?>','papelera')"><i class="fa fa-trash-o"></i> Papelera</button>
              <button id="btnImprimir2" type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
		</div>
<script type='text/javascript' src='<?php echo $page_url;?>modulos/mailbox/js/imprimir.js'></script>
<?php
	break;
	case($opc=='enviados'):
	body_list_mail();
	break;
	case($opc=='spam'):
	body_list_mail();
	break;
	case($opc=='borradores'):
	body_list_mail();
	break;
	case($opc=='papelera'):
	body_list_mail();
	break;
	default:
	body_list_mail();
	break;
}
?>
      </div><!--/.row-->
    </section>
    <!-- /.content -->
<?php 		
//	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>