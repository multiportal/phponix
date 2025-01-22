<?php 
switch(true){default:$tab='servicios';break;}
include 'conf_'.$tab.'.php';
function url_api(){global $page_url;$tabla=table();return $url_api=$page_url.'api/'.$tabla.'/';}
$btn_modal=($bmodal==1)?'data-toggle="modal" data-target="#modalForm"':'';
$tabla=table();
$url_api=url_api();
/** BACKEND */ ////////////////////////////////////////////////////////////////////////////////////

/** FRONTEND */ ////////////////////////////////////////////////////////////////////////////////////
function cadena_replace(&$replace1,&$replace2){
	$replace1=array(' ','.',',','(',')','/','"',"’",'á','é','í','ó','ú','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','Á','É','Í','Ó','Ú','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','ñ','Ñ','&ntilde;','&Ntilde;');
	$replace2=array('-','-','-','-','-','-','-',"",'a','e','i','o','u','a','e','i','o','u','A','E','I','O','U','A','E','I','O','U','n','N','n','N');
}

function servicios($categoria){
global $page_url,$mod,$tabla,$url_api;
$url_api=url_api();
sql_opciones('link_var', $valor);
$data = query_data($tabla, $url_api);
usort($data, function($b, $a){return strnatcmp($a['ID'], $b['ID']);}); //Orden por ID DESC
    if ($data != '' & $data != NULL) {
        $i = 0;
        foreach ($data as $row) {$i++;
            cadena_replace($replace1,$replace2);
            $rep1 = array(' ','í','ó','&iacute;','&oacute;');
            $rep2 = array('_','i','o','i','o');
			$ID      = $row['ID'];
			$cover   = $row['cover'];
			$nombre  = $row['nombre'];
			$des     = $row['descripcion'];
			$precio  = $row['precio'];
			$cate    = strtolower(str_replace($rep1, $rep2, $row['cate']));
            $visible = $row['visible'];
            //echo '<div>'.$cate.'='.$categoria.'</div>';
            if($visible==1 && $cate==$categoria){			
				if($_GET['tema_previo']!=''){$tema_p='&tema_previo='.$_GET['tema_previo'];}
				$link_zp=($tema_p!='' || $valor==1)?$page_url.'index.php?mod='.$mod.'&ext=item&id='.$ID.$tema_p:$page_url.''.$mod.'/item/'.$ID.'-'.$nom;
			  if($cate=='sistemas_contra_incendios'){
				  echo '<!--['.$i.'] -'.$row['ID'].'-->
				    <div class="row wthree-news-grids">
						<div class="col-md-6 col-xs-6 datew3-agileits">
							<img src="'.$page_url.'modulos/servicios/fotos/'.$cover.'" class="img-fluid" alt=""/>
						</div>
						<div class="col-md-6 col-xs-6 datew3-agileits-info ">
							<h4>'.$nombre.'</h4>
							'.$des.'
						</div>
					</div>
				  ';
			  }else{
				echo '<!--['.$i.'] -'.$row['ID'].'-->
				<div class="col-md-4 agileits_services_grid">
					<h3>'.$nombre.'</h3>
					'.$des.'
					<div class="w3_agile_services_grid1">
						<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" alt=" " class="img-fluid" />
					</div>
				</div>';
			  }
			}
        }
        if ($ID == '') {
            echo '<div class="col-lg-12 col-xs-12" style="height:100px"><div class="alert alert-danger">Por el momento no hay proyectos visibles.</div><div class="alert alert-info">*Regrese más tarde.</div></div>' . "\n";
        }
    } else {
        echo '<div class="col-lg-12 col-xs-12" style="height:100px"><div class="alert alert-danger">Por el momento no hay proyectos.</div><div class="alert alert-info">*Regrese más tarde.</div></div>' . "\n";
    }
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
				$jq(\'#'.$tag_id.'\').html(respuesta);
	   		}
		});
	}
	setInterval('.$fun.', '.$seg.'000);//setInterval(function(){'.$fun.'();},'.$seg.'000)//Actualizamos cada '.$seg.' segundo    	
	window.onload='.$fun.';
//});
</script>';
if($tag_id!=''){echo '<div id="'.$tag_id.'" class="row w3ls_banner_bottom_grids"></div>';}
}
?>