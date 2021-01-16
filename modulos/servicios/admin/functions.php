<?php 
/*//FUNCIONES ADMIN-LTE//*****************************************************************************/
function cadena_replace(&$replace1,&$replace2){
	$replace1=array(' ','.',',','(',')','/','"',"’",'á','é','í','ó','ú','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','Á','É','Í','Ó','Ú','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','ñ','Ñ','&ntilde;','&Ntilde;');
	$replace2=array('-','-','-','-','-','-','-',"",'a','e','i','o','u','a','e','i','o','u','A','E','I','O','U','A','E','I','O','U','n','N','n','N');
}

function html_iso_servicios(&$titulo){
global $chartset;
 if($chartset=='iso-8859-1'){
	$titulo=htmlentities($titulo, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function cate_add($cate){
global $mysqli,$DBprefix;	
$sql=mysqli_query($mysqli,"SELECT menu,ext FROM ".$DBprefix."menu_web WHERE ext!='';") or print mysqli_error($mysqli);
echo '<select class="form-control" id="cate" name="cate">
<option>Seleccionar Categoria</option>';
	while($row=mysqli_fetch_array($sql)){
		$seleccion=($row['ext']==$cate)?'selected':'';
		echo '<option value="'.$row['ext'].'" '.$seleccion.'>'.$row['menu'].'</option>';
	}
echo '</select>';	
}

function compact_ajax_mod($fun,$tag_id,$url_ajax,$seg,$jqs){
echo '<script>
var $jq = jQuery.noConflict();
//$(document).ready(function() {	
	function '.$fun.'(){
		$jq.ajax({
			type: \'POST\',
			url: \''.$url_ajax.'\',
			success: function(respuesta) {			
				$(\'#'.$tag_id.'\').html(respuesta);
	   		}
		});
	}
	setInterval('.$fun.', '.$seg.'000);//setInterval(function(){'.$fun.'();},'.$seg.'000)//Actualizamos cada '.$seg.' segundo    	
	window.onload='.$fun.';
//});
</script>';
if($tag_id!=''){echo '<div id="'.$tag_id.'" class="row w3ls_banner_bottom_grids"></div>';}
}

function crear_ajax_servicios(){
global $mysqli,$DBprefix,$page_url,$path_tema,$mod,$ext,$opc,$action,$URL;
$cond_opc=($opc!='')?'&opc='.$opc:'';
	
//ajax_crud($campos,$salidadebusaqueda,1=tinyMCE);
$campos='
			cover: $("#cover").val(),
			clave: $("#clave").val(),
			titulo: $("#titulo").val(),
			des: $("#des").val(),
			precio: $("#precio").val(),
			cate: $("#cate").val(),
			visible: $("#visible").val(),
      		id: $("#id").val()';
$template='
	<div class="col-md-3 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
       			<h3 class="box-title">C&oacute;digo: <b>${task.clave}</b></h3>
				<span class="controles">${sel}
					<a href="'.$page_url.'index.php?mod='.$mod.'&ext=admin/index'.$cond_opc.'&form=1&action=edit&id=${task.ID}" title="Editar"><i class="fa fa-edit"></i></a> | <a href="#" taskid="${task.ID}" class="task-delete" title="Borrar"><i class="fa fa-trash"></i></a>
				</span>
			</div>
			<div class="box-body">
				<div class="ima-size">
					<img src="'.$page_url.'modulos/'.$mod.'/fotos/${task.cover}" class="ima-size img-responsive">
				</div>
				<div id="title"><strong>${task.titulo}</strong></div>	
			</div><!-- /.box-body -->
		</div>
	</div>';
ajax_crud($campos,$template,1);
}

/*//ARCHIVOS MODULOS: SERVICIOS//*****************************************************************************/
function servicios($categoria){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$username,$nivel_login;
$tabla='servicios';
$fjson=$tabla.'.json';
$path_JSON='../../../bloques/webservices/rest/json/'.$fjson;
 if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/'.$tabla.'/';}
 echo $rut_origen=($nivel_login==-1)?'<!-- '.$fjson.' -->'."\n\r":'<!-- '.$fjson.' URL:('.$path_JSON.')-->'."\n\r";
 if($path_JSON){
	$objData=file_get_contents($path_JSON);
	$Data=json_decode($objData,true);
	$i=0;
	if($Data!='' && $Data!=NULL){
		echo '<!-- '.$fjson.' -->';
		foreach ($Data as $reg){$i++;
			cadena_replace($replace1,$replace2);
			$ID=$reg['ID'];
			$cover=$reg['cover'];
			$titulo=$reg['titulo'];
			$des=$reg['descripcion'];
			$precio=$reg['precio'];
			$cate=$reg['cate'];
			$visible=$reg['visible'];

			//$curso=strpos($cate, $tipo);
			if($visible==1 && $cate==$categoria){			
				if($_GET['tema_previo']!=''){$tema_p='&tema_previo='.$_GET['tema_previo'];}
				$link_zp=($tema_p!='' || $valor==1)?$page_url.'index.php?mod='.$mod.'&ext=item&id='.$ID.$tema_p:$page_url.''.$mod.'/item/'.$ID.'-'.$nom;
			  if($cate=='sistemas_contra_incendios'){
				  echo '<!--['.$i.'] -'.$reg['ID'].'-->
				    <div class="row wthree-news-grids">
						<div class="col-md-6 col-xs-6 datew3-agileits">
							<img src="'.$page_url.'modulos/servicios/fotos/'.$cover.'" class="img-fluid" alt=""/>
						</div>
						<div class="col-md-6 col-xs-6 datew3-agileits-info ">
							<h4>'.$titulo.'</h4>
							'.$des.'
						</div>
					</div>
				  ';
			  }else{
				echo '<!--['.$i.'] -'.$reg['ID'].'-->
				<div class="col-md-4 agileits_services_grid">
					<h3>'.$titulo.'</h3>
					'.$des.'
					<div class="w3_agile_services_grid1">
						<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" alt=" " class="img-fluid" />
					</div>
				</div>';
			  }
			}
		}		
		echo '<!-- /'.$fjson.' -->';
	}	
 }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento No hay Servicios disponibles.</div>
		</div>
	';
 }
}
?>