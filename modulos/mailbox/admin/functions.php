<?php
function html_iso(&$nombre,&$email,&$subject,&$msj){
global $chartset;
 if($chartset=='iso-8859-1'){
 	$nombre = htmlentities($nombre, ENT_COMPAT,'ISO-8859-1', true);
	$email=htmlentities($email, ENT_COMPAT,'ISO-8859-1', true);
	$subject = htmlentities($subject, ENT_COMPAT,'ISO-8859-1', true);
	$msj = htmlentities($msj, ENT_COMPAT,'ISO-8859-1', true);	
 }
}

function html_iso_mailbox(&$m_nombre,&$m_asunto){
global $chartset;
 if($chartset=='iso-8859-1'){
 	$m_nombre = htmlentities($m_nombre, ENT_COMPAT, 'UTF-8', true);
 	$m_asunto = htmlentities($m_asunto, ENT_COMPAT, 'UTF-8', true);
 }
}

function query_mailbox(&$num_rows,&$m_tabla,$buzon){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
//$sql=mysqli_query($mysqli,"SELECT * FROM `".$DBprefix."contacto` WHERE visible=1 AND cat_list='{$buzon}' UNION ALL SELECT * FROM `".$DBprefix."registros` WHERE visible=1 AND cat_list='{$buzon}' ORDER BY fecha DESC;") or print mysqli_error($mysqli); 
$sql=mysqli_query($mysqli,"SELECT * FROM `".$DBprefix."contacto` WHERE visible=1 AND cat_list='{$buzon}' ORDER BY fecha DESC;") or print mysqli_error($mysqli); 
$num_rows=mysqli_num_rows($sql);
while($row=mysqli_fetch_array($sql)){
$m_id=$row['ID'];
$m_ip=$row['ip'];
$m_nombre=$row['nombre'];
$m_para=$row['para'];
$m_email=$row['email'];
$m_title=$row['titulo'];
$m_asunto=$row['asunto'];
$m_msj=$row['msj'];
$m_fecha=$row['fecha'];
$m_cat_list=$row['cat_list'];
$m_seccion=$row['seccion'];
$m_adjuntos=$row['adjuntos'];
$m_visto=$row['visto'];
$m_visble=$row['visible'];

if($m_title!=''){
	$m_asunto=($m_visto!=0)?$m_title:'<b>'.$m_title.'</b>';
}else{
	$m_asunto=($m_visto!=0)?$m_asunto:'<b>'.$m_asunto.'</b>';	
}
$clip=($m_adjuntos!='')?'<i class="fa fa-paperclip"></i>':'';
html_iso_mailbox($m_nombre,$m_subject);
$m_tabla.='
                  <tr>
                    <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                    <td class="mailbox-name"><a href="'.$page_url.'index.php?mod='.$mod.'&opc=read_msg&id='.$m_id.'&sec='.$m_seccion.'">'.$m_nombre.'</a></td>
                    <td class="mailbox-subject"><a href="'.$page_url.'index.php?mod='.$mod.'&opc=read_msg&id='.$m_id.'&sec='.$m_seccion.'">'.$m_asunto.' </a></td>
                    <td class="mailbox-attachment">'.$clip.'</td>
                    <td class="mailbox-date">'.$m_fecha.'&nbsp;&nbsp;[<i class="fa fa-inbox" title="Inbox" onclick="confirm1('.$m_id.',\''.$m_seccion.'\',\'inbox\')" style="cursor:pointer;"></i>]&nbsp;&nbsp;[<i class="fa fa-filter" title="Spam" onclick="confirm1('.$m_id.',\''.$m_seccion.'\',\'spam\')" style="cursor:pointer;"></i>]&nbsp;&nbsp;[<i class="fa fa-trash-o" title="Papelera" onclick="confirm1('.$m_id.',\''.$m_seccion.'\',\'papelera\')" style="cursor:pointer;"></i>]</td>
                  </tr>
';	
}
mysqli_close($mysqli);
}

function cant_buzon($buzon){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
//$sql=mysqli_query($mysqli,"SELECT * FROM `".$DBprefix."contacto` WHERE visto!=1 AND visible=1 AND cat_list='{$buzon}' UNION ALL SELECT * FROM `".$DBprefix."registros` WHERE visto!=1 AND visible=1 AND cat_list='{$buzon}' ORDER BY fecha DESC;") or print mysqli_error($mysqli); 
$sql=mysqli_query($mysqli,"SELECT * FROM `".$DBprefix."contacto` WHERE visto!=1 AND visible=1 AND cat_list='{$buzon}' ORDER BY fecha DESC;") or print mysqli_error($mysqli); 
$num_rows=mysqli_num_rows($sql);
echo $num_rows;
}

function mail_bar(){
global $page_url,$mod,$opc,$num_inbox,$id;
$opc_ban=($opc=='')?' class="active"':'';
$opc_env=($opc=='enviados')?' class="active"':'';
$opc_bor=($opc=='borradores')?' class="active"':'';
$opc_spa=($opc=='spam')?' class="active"':'';
$opc_pap=($opc=='papelera')?' class="active"':'';	
echo '
          <a href="'.$page_url.'index.php?mod='.$mod.'&opc=send_msg" class="btn btn-primary btn-block margin-bottom">Redactar</a>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li'.$opc_ban.'><a href="'.$page_url.'index.php?mod='.$mod.'"><i class="fa fa-inbox"></i> Bandeja de Entrada
                  <span class="label label-primary pull-right">';
				  cant_buzon('inbox');
echo		    '&nbsp;<span id="online2"></span></span></a></li>
                <li'.$opc_env.'><a href="'.$page_url.'index.php?mod='.$mod.'&opc=enviados"><i class="fa fa-envelope-o"></i> Enviados
                  <span class="label label-primary pull-right">';
				  cant_buzon('enviados');
echo			'</span></a></li>
                <li'.$opc_bor.'><a href="'.$page_url.'index.php?mod='.$mod.'&opc=borradores"><i class="fa fa-file-text-o"></i> Borradores
                  <span class="label label-primary pull-right">';
				  cant_buzon('borradores');
echo			'</span></a></li>
                <li'.$opc_spa.'><a href="'.$page_url.'index.php?mod='.$mod.'&opc=spam"><i class="fa fa-filter"></i> No Deseado (Spam)
                  <span class="label label-primary pull-right">';
				  cant_buzon('spam');
echo			'</span></a></li>
                <li'.$opc_pap.'><a href="'.$page_url.'index.php?mod='.$mod.'&opc=papelera"><i class="fa fa-trash-o"></i> Papelera
                  <span class="label label-primary pull-right">';
				  cant_buzon('papelera');
echo			'</span></a></li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /. box -->
		  
          <!--div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Labels</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
              </ul>
            </div><!-- /.box-body ->
          </div><!-- /.box -->
';
}

function body_list_mail(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
global $num_inbox,$m_tabla;
$title_buzon=($opc=='')?'inbox':$opc;
query_mailbox($num_rows,$m_tabla,$title_buzon);
echo '
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">'.$title_buzon.'</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Buscar Mail" />
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <!--
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                  -->
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" onClick="javascript:document.location.href=\''.$URL.'\';"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  Total de Mensajes: '.$num_rows.'
                  <!--div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div-->
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  '.$m_tabla.'
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <!--
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                  -->
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" onClick="javascript:document.location.href=\''.$URL.'\';"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  Total de Mensajes: '.$num_rows.'
                  <!--div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div-->
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
';
}
?>