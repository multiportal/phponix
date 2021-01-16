<?php 
//FUNCIONES ESPECIALES
function open_page_LTE(){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL;
global $mod,$ext,$idp,$vhref,$refer,$opc,$action,$ext2;
global $page_name,$title,$dominio,$path_root,$pag_url,$keywords,$description,$metas,$meta_chartset,$google_analytics,$tel1,$phone,$webMail,$contactMail,$mode,$chartset,$dboard,$dboard2,$direc,$CoR,$CoE,$BCC,$CoP,$fb_web,$tw_web,$gp_web,$lk_web,$yt_web;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $ID_mod,$nombre_mod,$modulo_mod,$description_mod,$dashboard_mod,$nivel_mod,$home_mod,$visible_mod,$activo_mod,$sname_mod,$icono_mod,$link_mod,$qmod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
global $BLOCK,$path_dashboard,$slide;

sql_opciones('mini_bar_AdminLTE',$valor);
$mini_bar=($valor!=0)?'sidebar-collapse':'';
sql_opciones('skin_AdminLTE',$valor);
$color_skin=($valor!='')?$valor:'blue';
echo '<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="'.$chartset.'">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard - '.$title.'</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"-->
  <link rel="stylesheet" href="'.$page_url.'assets/css/font-awesome-4.7.0/css/font-awesome.css">
  <!-- Ionicons -->
  <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"-->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'dist/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'plugins/datatables/dataTables.bootstrap.css">
  <!-- Select-Icon -->
  <link rel="stylesheet" href="'.$page_url.'assets/bootstrap-select/dist/css/bootstrap-select.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'plugins/iCheck/all.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'plugins/datepicker/datepicker3.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'plugins/timepicker/bootstrap-timepicker.min.css">
  <!--style-->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'dist/css/style.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="'.$page_url.$path_dashboard.'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  '.$javascript.'
</head>
<body class="hold-transition skin-'.$color_skin.' sidebar-mini '.$mini_bar.'">
';
}

function menu_gentelella(){
global $mysqli,$DBprefix;
global $year,$month,$day,$fecha,$date,$time;
global $ip,$IPv4,$host,$pag_self,$page_url,$url,$URL;
global $mod,$ext,$idp,$vhref,$refer,$opc,$action,$ctrl,$ext2;
global $logo,$page_name,$title,$dominio,$path_root,$pag_url,$keywords,$description,$metas,$meta_chartset,$google_analytics,$tel1,$tel2,$phone,$wapp,$webMail,$contactMail,$contactMail2,$mode,$chartset,$dboard,$dboard2,$direc,$direc2,$CoR,$CoE,$BCC,$CoP,$fb_web,$tw_web,$gp_web,$lk_web,$yt_web,$ls_web,$ins_web,$ver_web,$ncod,$cms,$ls_encrip,$control,$vence,$pw_admin,$sas_lic,$cil,$tcil;
global $cont_tema,$tema,$subtema,$path_t,$path_tema,$ruta_mod;
global $ID_mod,$nombre_mod,$modulo_mod,$description_mod,$dashboard_mod,$nivel_mod,$home_mod,$visible_mod,$activo_mod,$sname_mod,$icono_mod,$link_mod,$qmod;
global $style,$font_awesome,$bootstrap,$bootstrapjs,$javascript,$jQuery,$jQuery10,$base_target,$back;
global $BLOCK,$path_dashboard,$slide;
global $msj_recibidos;
user_login($ID_login,$username,$email_login,$nivel_login,$last_login,$tema_login,$nombre_login,$apaterno_login,$amaterno_login,$foto_login,$cover_login,$tel_login,$ext_login,$fnac_login,$fb_login,$tw_login,$puesto_login,$ndepa_login,$depa_login,$empresa_login,$adress_login,$direccion_login,$mpio_login,$edo_login,$genero_login,$exp_login,$like_login,$filtro_login,$zona_login,$alta_login,$actualizacion_login,$page_login,$nivel_oper_login,$rol_login);
echo '
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="'.$page_url.'modulos/usuarios/fotos/'.$foto_login.'" alt="">'.$username.'
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="'.$page_url.'index.php?mod=usuarios&ext=perfil_sesion"> Perfil</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="'.logout($ID_login).'"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">'.$msj_recibidos.'</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="'.$page_url.$path_dashboard.'production/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a href="'.$page_url.'index.php?mod=mailbox">
                          <strong>Ver todos lo mensajes</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
';
}

function editor_tiny_mce(){
global $page_url,$path_tema;
echo '
<script type="text/javascript" src="'.$page_url.'assets/plugins/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        language : "es", 
        theme : "advanced",
        convert_urls : false,
        relative_urls : false,
        content_css : "'.$page_url.$path_tema.'css/style.css",
        plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,ibrowser",
        // Theme options
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,sub,sup",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,ibrowser,cleanup,help,code",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,spellchecker,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        spellchecker_languages : "English=en,+Spanish=es",
        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",
    });
</script>
';
}
/*---Funciones para el Modulo: sys/menu_admin.php---*/
function sel_menu_adm(){
global $mysqli,$DBprefix,$ID_adm;
echo'<select class="form-control" id="ID_menu_adm" name="ID_menu_adm">
<option value="0">--Elige Menu--</option>';
$sqladm=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_admin WHERE ID_menu_adm=0 AND ID_mod=0 AND visible=1;") or print mysqli_error($mysqli); 
while($row=mysqli_fetch_array($sqladm)){$idm=$row['ID'];$nombre=$row['nom_menu'];
	$sel=($ID_adm==$idm)?'Selected':'';
	echo '<option value="'.$idm.'" '.$sel.'>'.$nombre.'</option>';
}
echo'</select>';
}

function sel_menu_mod(){
global $mysqli,$DBprefix,$ID_mod;
echo'<select class="form-control" id="ID_mod" name="ID_mod">
<option value="0">--Elige Menu--</option>';
$sqladm=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."modulos WHERE visible=1;") or print mysqli_error($mysqli); 
while($row=mysqli_fetch_array($sqladm)){$idm=$row['ID'];$nombre=$row['nombre'];
	$sel=($ID_mod==$idm)?'Selected':'';
	echo '<option value="'.$idm.'" '.$sel.'>'.$nombre.'</option>';
}
echo'</select>';
}
//FUNCIONES GENERALES DE DASHBOARD
function menu_rutas(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$ext2,$opc,$action;
echo '      <ol class="breadcrumb">
        <li><a href="'.$page_url.'index.php?mod=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a target="_blank" href="'.$page_url.'index.php?mod='.$mod.'">'.$mod.'</a></li>
';
if($ext!=''&&$ext!='index'){
	echo '<li><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'">'.$ext2.'</a></li>';
}
if($opc){
	echo '<li><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'">'.$opc.'</a></li>';
} 
if($action){
	echo '<li><a href="#">'.$action.'</a></li>';
}
echo '      </ol>
';
}

function breadcrumb(){
global $mysqli,$DBprefix,$page_url,$nombre_mod,$mod,$ext,$ext2,$opc,$action;
echo '<ol class="breadcrumb">
  <li><a href="'.$url.'?mod=dashboard"><i class="demo-pli-home"></i> </a></li>
';
if($mod!='' && $ext!='' && $ext!='admin/index'){
  echo '<li><a href="'.$url.'?mod='.$mod.'">'.$nombre_mod.'</a></li>';
}else{
  echo '<li class="active">'.$nombre_mod.'</li>';
}

if($ext!='' && $ext!='index' && $ext!='admin/index'){
	echo '<li><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'">'.$ext2.'</a></li>';
}

if($opc){
	echo '<li><a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.'&opc='.$opc.'">'.$opc.'</a></li>';
}

if($action){
	echo '<li><a href="#">'.$action.'</a></li>';
}
echo '</ol>';
}

function menu_mod($tab_m,$niv){
global $mysqli,$DBprefix,$nivel,$page_url;
user_login($ID_login,$username,$email_login,$nivel_login,$last_login,$tema_login,$nombre_login,$apaterno_login,$amaterno_login,$foto_login,$cover_login,$tel_login,$ext_login,$fnac_login,$fb_login,$tw_login,$puesto_login,$ndepa_login,$depa_login,$empresa_login,$adress_login,$direccion_login,$mpio_login,$edo_login,$edo_login,$genero_login,$exp_login,$like_login,$filtro_login,$zona_login,$alta_login,$actualizacion_login,$page_login,$nivel_oper_login,$rol_login);
switch(true){
	case($tab_m=='modulos');
	$niv_mod=($nivel_login!=-1)?"(nivel=0 OR nivel='{$nivel_login}') AND activo=1":"nivel!=-1 AND activo=1";
	if($niv==-1){$niv_mod="nivel=-1 AND activo=1";}else{$niv_mod=$niv_mod;}
	$niv_mod2=($nivel_login!=-1)?"(nivel=0 OR nivel='{$nivel_login}')":"nivel!=''";
	$nom_m_a='nombre';$ID_m_a="ID_mod";$aindex='&ext=admin/index';
	break;
	case($tab_m=='menu_admin');
	$niv_mod=($nivel_login!=-1)?"(nivel=0 OR nivel='{$nivel_login}') AND ID_menu_adm=0 AND ID_mod=0":"nivel!=-1 AND ID_menu_adm=0 AND ID_mod=0";
	if($niv==-1){$niv_mod="nivel=-1 AND ID_menu_adm=0 AND ID_mod=0";}else{$niv_mod=$niv_mod;}
	$niv_mod2="nivel!=''";
	$nom_m_a='nom_menu';$ID_m_a="ID_menu_adm";
	break;
}
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tab_m." WHERE {$niv_mod} AND visible=1 ORDER BY {$nom_m_a} ASC;") or print mysqli_error($mysqli); 
while($row=mysqli_fetch_array($sql)){$id_m=$row['ID'];$nombre=$row[$nom_m_a];$icono=$row['icono'];$link=$row['link'];
	$sql1=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_admin WHERE ({$ID_m_a}='{$id_m}') AND {$niv_mod2} AND visible=1;") or print mysqli_error($mysqli); 
	$top_menu='';
	while($row1=mysqli_fetch_array($sql1)){$id_sub=$row1[$ID_m_a];$nombre_a=$row1['nom_menu'];$icono_a=$row1['icono'];$link_a=$row1['link'];
		$link_a=($link_a=='')?'#':$page_url.$link_a;
		$top_menu.='<li><a href="'.$link_a.'"><i class="fa '.$icono_a.'"></i> '.$nombre_a.'</a></li>';
	}
	if($id_sub==$id_m){
		$menu_modulos.='
		<li class="treeview">
          <a href="#">
            <i class="fa '.$icono.'"></i> <span>'.$nombre.'</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		  	'.$top_menu.'
          </ul>
        </li>
		';
	}else{
		$link=($link=='')?'#':$page_url.$link.$aindex;
		//$menu_modulos.='<li><a href="'.$page_url.$link.$aindex.'"><i class="fa '.$icono.'"></i> <span>'.$nombre.'</span></a></li>';
		$menu_modulos.='<li><a href="'.$link.'"><i class="fa '.$icono.'"></i> <span>'.$nombre.'</span></a></li>'; 
	}
}
echo $menu_modulos;
}

function menu_mod_gen($tab_m,$niv){
global $mysqli,$DBprefix,$nivel,$page_url;
user_login($ID_login,$username,$email_login,$nivel_login,$last_login,$tema_login,$nombre_login,$apaterno_login,$amaterno_login,$foto_login,$cover_login,$tel_login,$ext_login,$fnac_login,$fb_login,$tw_login,$puesto_login,$ndepa_login,$depa_login,$empresa_login,$adress_login,$direccion_login,$mpio_login,$edo_login,$edo_login,$genero_login,$exp_login,$like_login,$filtro_login,$zona_login,$alta_login,$actualizacion_login,$page_login,$nivel_oper_login,$rol_login);
switch(true){
	case($tab_m=='modulos');
	$niv_mod=($nivel_login!=-1)?"(nivel=0 OR nivel='{$nivel_login}') AND activo=1":"nivel!=-1 AND activo=1";
	if($niv==-1){$niv_mod="nivel=-1 AND activo=1";}else{$niv_mod=$niv_mod;}
	$niv_mod2=($nivel_login!=-1)?"(nivel=0 OR nivel='{$nivel_login}')":"nivel!=''";
	$nom_m_a='nombre';$ID_m_a="ID_mod";$aindex='&ext=admin/index';
	break;
	case($tab_m=='menu_admin');
	$niv_mod=($nivel_login!=-1)?"(nivel=0 OR nivel='{$nivel_login}') AND ID_menu_adm=0 AND ID_mod=0":"nivel!=-1 AND ID_menu_adm=0 AND ID_mod=0";
	if($niv==-1){$niv_mod="nivel=-1 AND ID_menu_adm=0 AND ID_mod=0";}else{$niv_mod=$niv_mod;}
	$niv_mod2="nivel!=''";
	$nom_m_a='nom_menu';$ID_m_a="ID_menu_adm";
	break;
}
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tab_m." WHERE {$niv_mod} AND visible=1 ORDER BY {$nom_m_a} ASC;") or print mysqli_error($mysqli); 
while($row=mysqli_fetch_array($sql)){$id_m=$row['ID'];$nombre=$row[$nom_m_a];$icono=$row['icono'];$link=$row['link'];
	$sql1=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_admin WHERE ({$ID_m_a}='{$id_m}') AND {$niv_mod2} AND visible=1;") or print mysqli_error($mysqli); 
	$top_menu='';
	while($row1=mysqli_fetch_array($sql1)){$id_sub=$row1[$ID_m_a];$nombre_a=$row1['nom_menu'];$icono_a=$row1['icono'];$link_a=$row1['link'];
		$link_a=($link_a=='')?'#':$page_url.$link_a;
		$top_menu.='<li><a href="'.$link_a.'"><i class="fa '.$icono_a.'"></i> '.$nombre_a.'</a></li>';
	}
	if($id_sub==$id_m){
		$menu_modulos.='
		<li>
          <a><i class="fa '.$icono.'"></i> '.$nombre.'<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
		  	'.$top_menu.'
		  </ul>
        </li>
		';
	}else{
		$link=($link=='')?'#':$page_url.$link.$aindex;
		//$menu_modulos.='<li><a href="'.$page_url.$link.$aindex.'"><i class="fa '.$icono.'"></i> <span>'.$nombre.'</span></a></li>';
		$menu_modulos.='<li><a href="'.$link.'"><i class="fa '.$icono.'"></i> <span>'.$nombre.'</span></a></li>'; 
	}
}
echo $menu_modulos;
}

function panel_menu(){
global $mysqli,$DBprefix,$mod,$ID_mod;

	$sql_ma=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_admin WHERE (ID_menu_adm='{$ID_mod}' OR ID_mod='{$ID_mod}') AND visible=1 ORDER BY ID ASC;") or print mysqli_error($mysqli); 
	$num_ma=mysqli_num_rows($sql_ma);
	if($num_ma!=0){
		while($row=mysqli_fetch_array($sql_ma)){$nom_ma=$row['nom_menu'];$icono_ma=$row['icono'];
			$linksm=($row['link']=='') ? '#' : $page_url.$row['link'];
			$panel_menu.='<span><a href="'.$linksm.'"><i class="fa '.$icono_ma.'"></i> '.$nom_ma.'</a></span> | ';
		}
	echo'
	<div class="col-xs-12 col-md-12" style="padding:0px 6px;">
   	<div class="panel panel-default">
  		<div class="panel-heading">
    		<h3 class="panel-title">Panel <span style="float:right;"><a href="#" title="Info del modulo: '.$mod.'"><i class="fa fa-info-circle"></i></a></span></h3>
  		</div>
  		<div class="panel-body">
			'.$panel_menu.'
  		</div>
	</div>
	</div>';
	}	
}

function orden($tabla,&$ord){
global $mysqli,$DBprefix;
 $sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix.$tabla." ORDER BY ord DESC;") or print mysqli_error($mysqli); 
 if($row=mysqli_fetch_array($sql)){$ord1=$row['ord'];}$ord=$ord1+1;
}

function mensajes_recibidos(){
global $mysqli,$DBprefix;
//MENSAJES
$sql2=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."contacto WHERE visto!=1 AND visible=1;") or print mysqli_error($mysqli);
$msj_hoy2=mysqli_num_rows($sql2);
$sql3=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."registros WHERE visto!=1 AND visible=1;") or print mysqli_error($mysqli);
$msj_hoy3=mysqli_num_rows($sql3);
$msj_recibidos=$msj_hoy2+$msj_hoy3;
echo $msj_recibidos;
}

function num_email(&$num_email,&$msj_email,&$ID_e){
global $mysqli,$DBprefix,$path_dashboard;
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."contacto WHERE visto!=1 AND visible=1 ORDER BY ID DESC LIMIT 5;") or print mysqli_error($mysqli);
$num_email=mysqli_num_rows($sql);
  while($row=mysqli_fetch_array($sql)){
    $ID_e=$row['ID'];$nombre=$row['nombre'];$email=$row['email'];$titulo=$row['titulo'];$fecha=$row['fecha'];
    $msj_email.='
                  <li><!--'.$ID_e.'-->
                    <a href="'.$page_url.'index.php?mod=mailbox&opc=read_msg&id='.$ID_e.'&sec=contacto">
                      <div class="pull-left">
                        <!--img src="'.$page_url.$path_dashboard.'dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"-->
                        <i class="fa fa-envelope-o"></i>
                      </div>
                      <h4>
                        De: '.$nombre.'
                        <small><i class="fa fa-clock-o"></i></small>
                      </h4>
                      <p>'.$titulo.' ['.$fecha.']</p>
                    </a>                    
                  </li>';
  }
}

function compact_ajax_msj($fun,$tag_id,$url_ajax,$seg,$jqs){
echo '<script>
//var $jq = jQuery.noConflict();
//$(document).ready(function() {  
  function '.$fun.'(){
    $.ajax({
      type: \'POST\',
      url: \''.$url_ajax.'\',
      success: function(respuesta) {      
        $(\'#'.$fun.'\').html(respuesta);
        }
    });
  }
  setInterval('.$fun.', '.$seg.'000);//setInterval(function(){'.$fun.'();},'.$seg.'000)//Actualizamos cada '.$seg.' segundo     
  window.onload='.$fun.';
//});
</script>';
if($tag_id!=''){echo $tag_id;}
}

function visitas_hoy(){
global $mysqli,$DBprefix,$year,$month,$day;
$sql=mysqli_query($mysqli,"SELECT DISTINCT ip FROM ".$DBprefix."visitas WHERE fecha>='{$year}-{$month}-{$day} 00:00:00' AND fecha<='{$year}-{$month}-31 23:59:59';") or print mysqli_error($mysqli);
$visitas_hoy=mysqli_num_rows($sql);
echo $visitas_hoy;
}

function num_blog(){
global $mysqli,$DBprefix,$page_url;
$sql=@mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."blog WHERE visible=1;");
$num_blog=mysqli_num_rows($sql);
echo $num_blog;
}

function num_tareas(&$num_tareas,&$nom_tarea,&$ID_t){
global $mysqli,$DBprefix,$page_url;
$sql=@mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."tareas WHERE visible=1;");
$num_tareas=mysqli_num_rows($sql);
while($row=mysqli_fetch_array($sql)){$ID_t=$row['ID'];$nom_tarea=$row['nom'];}
}

function num_noti(&$num_noti,&$msj_noti,&$ID_n){
global $mysqli,$DBprefix;
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."notificacion WHERE ID_user='1' AND activo=1;") or print mysqli_error($mysqli);
$num_noti=mysqli_num_rows($sql);
while($row=mysqli_fetch_array($sql)){$ID_n=$row['ID'];$msj_noti=$row['mensaje'];}
}

function noti_chrome($url_ajax,$seg,$dura,$jqs){
global $mysqli,$DBprefix,$page_url;
if($jqs==1){echo '<script src="'.$page_url.'bloques/push/js/jquery-1.11.1.min.js"></script>';}
echo '
<script src="'.$page_url.'bloques/push/js/push.min.js"></script> <!-- incluye la libreria push -->
<script> 
function ver(){  
 $.ajax({ //se inicia la petición ajax al archivo que consulta los mensajes en la base de datos
    type : \'GET\', //consulta mediante get
    url : \''.$url_ajax.'\', //url del archivo a consultar
    data : {\'ID_user\':\'1\'}, //consulta el id del propietario
    dataType : \'json\', //se espera retornar un json
    success : function(data) { //si fue satisfactorio la petición ajax retorna la variable data con la información
    	$.each(data, function(i, item) { //recorremos el json para obtener los mensajes
        	var texto = item.texto;
        	var emisor = item.emisor;
        	var num_msg = item.num_msg;
                        
            if(num_msg>0){
            	Push.create(emisor, { //llamamos al objeto push escrito en jquery
                	body: texto, //ingresamos el texto recuperado de la petición ajax
					icon: \'temas/default/images/logo.png\',					
                    timeout: '.$dura.'000, //con este valor indica que despues de 4000 ms se cierre automaticamente el mensaje
                    vibrate: [100,100,100],
					onClick: function () { //al hacer click en la notificación se cerrará
						window.focus();
						this.close();
					}
				});
			}
        
		});
	},
 }); 
}
setInterval(ver,'.$seg.'000); //cada 10000 ms se ejecuta la función ver para obtener los mensajes recibidos
//recordar que cada 1000 ms es lo mismo que 1 segundo
</script>';
}

function head_producto(){
global $mysqli,$DBprefix,$page_url,$path_tema,$mod,$ext,$opc,$URL;
$cond_opc=($opc!='')?'&opc='.$opc:'';
echo '
		<div class="col-md-3 col-xs-12">
			<div class="input-group">
				<input type="search" id="q" class="form-control" placeholder="Buscar por nombre">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" onclick="load(1);"><i class="fa fa-search"></i></button>
				</span>
			</div><!-- /input-group -->
		</div>
		<div class="col-md-3 hidden-xs"></div>
		<div class="col-md-1 col-xs-2">
			<!--div id="loader" class="text-center"></div-->
		</div>
		<div class="col-md-5 col-xs-10">
			<div class="btn-group pull-right">
				<!--a href="#" class="btn btn-default" data-toggle="modal" data-target="#Producto"><i class="fa fa-plus"></i> Nuevo</a-->
				<a href="'.$page_url.'index.php?mod='.$mod.'&ext='.$ext.$cond_opc.'&form=1&action=add" class="btn btn-default"><i class="fa fa-plus"></i> Nuevo</a>
				<!--button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Mostrar <span class="fa fa-caret-down"></span>
				</button>
				<ul class="dropdown-menu pull-right">
				  <li class="active" onclick="per_page(15);" id="15"><a href="#">15</a></li>
				  <li onclick="per_page(25);" id="25"><a href="#">25</a></li>
				  <li onclick="per_page(50);" id="50"><a href="#">50</a></li>
				  <li onclick="per_page(100);" id="100"><a href="#">100</a></li>
				  <li onclick="per_page(1000000);" id="1000000"><a href="#">Todos</a></li>
				</ul-->
			</div>
		</div>
		<input type="hidden" id="per_page" value="15">
';
}

function paginate($reload, $page, $tpages, $adjacents) {
	$prevlabel = "&lsaquo; Anterior";
	$nextlabel = "Siguiente &rsaquo;";
	$out = '<ul class="pagination pagination-sm no-margin pull-right">';
	
	// previous label
	if($page==1) {
		$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
	} else if($page==2) {
		$out.= "<li><span><a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
	}else {
		$out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a></span></li>";
	}
	
	// first label
	if($page>($adjacents+1)) {
		$out.= "<li><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
	}

	// interval 
	if($page>($adjacents+2)){$out.= "<li><a>...</a></li>";}

	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li class='active'><a>$i</a></li>";
		}else if($i==1) {
			$out.= "<li><a href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
		}else {
			$out.= "<li><a href='javascript:void(0);' onclick='load(".$i.")'>$i</a></li>";
		}
	}

	// interval 
	if($page<($tpages-$adjacents-1)) {$out.= "<li><a>...</a></li>";}

	// last
	if($page<($tpages-$adjacents)) {
		$out.= "<li><a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a></li>";
	}

	// next
	if($page<$tpages) {
		$out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a></span></li>";
	}else {
		$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
	}
	
	$out.= "</ul>";
	return $out;
}

function crear_ws($tabla){
global $mysqli,$DBprefix;
 	$query="SELECT * FROM ".$DBprefix.$tabla." ORDER BY ID ASC;";
	crear_json($query,'bloques/webservices/rest/json/',$tabla.'.json');
}
?>