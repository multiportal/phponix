<?php 
switch(true){case($opc=='categoria'):$tab='cate';break;case($opc=='subcategoria'):$tab='sub_cate';break;default:$tab='productos';break;}
include 'conf_'.$tab.'.php';
function url_api(){global $page_url;$tabla=table();return $url_api=$page_url.'api/'.$tabla.'/';}
$btn_modal=($bmodal==1)?'data-toggle="modal" data-target="#modalForm"':'';
$tabla=table();
$url_api=url_api();
/** BACKEND */ ////////////////////////////////////////////////////////////////////////////////////
function categoria($ID_cate){
$tabla='productos_cate';
$data = query_data($tabla, $url_api=NULL);
    if ($data != '' & $data != NULL) {
        foreach ($data as $campo => $dato) {
            $ID=$dato['ID'];
            if($ID==$ID_cate){
              $categoria=$dato['categoria'];
            }
        }
        return $categoria;
    }    
}

function jQuery_select_cate_subcate(){
echo '
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script language="javascript">
$(document).ready(function(){
    $("#ID_cate").on(\'change\', function () {
        $("#ID_cate option:selected").each(function () {
            elegido=$(this).val();            
            $.post("modulos/productos/admin/backend.php?action=select_cate_subcate", { elegido: elegido }, function(resp){
                $("#ID_sub_cate").html(resp);
            });
            $.post("modulos/productos/admin/backend.php?action=select_cate", { elegido: elegido }, function(data){
                $("#cate").val(data);
            });             	
        });
   });
});
</script>
';
}

function select_cate($cate){
$tabla='productos_cate';
$data = query_data($tabla, $url_api);
    if ($data != '' & $data != NULL) {
        foreach ($data as $campo => $dato) {
            $ID_cate=$dato['ID'];$clave=$dato['ord'];$categoria=$dato['categoria'];
            $seleccion=($ID_cate==$cate)?'selected' : '';
            $option.='<option value="'.$ID_cate.'" '.$seleccion.'>'.$clave.' '.$categoria.'</option>';
        }
    }
echo '<option value="">Seleccionar Categoría</option>'.$option;
}

function select_sub_cate($ID_cate,$ID_sub_cate){
$tabla='productos_sub_cate';
$data = query_data($tabla, $url_api);
if ($data != '' & $data != NULL) {
    foreach ($data as $campo => $dato) {
        $ID=$dato['ID'];$clave=$dato['ord'];$subcategoria=$dato['subcategoria'];
        if($dato['ID_cate']==$ID_cate){
            $seleccion=($ID==$ID_sub_cate)?'selected' : '';
            $option.='<option value="'.$ID.'" '.$seleccion.'>'.$clave.' '.$subcategoria.'</option>';
        }
    }
}
echo '<option value="">Seleccionar Subcategoría</option>'.$option;	
}

function select_marcas($ID_marca){
$tabla='productos_marcas';
$data = query_data($tabla, $url_api);
    if ($data != '' & $data != NULL) {
        foreach ($data as $campo => $dato) {
            $ID=$dato['ID'];$nombre=$dato['nombre'];
            $seleccion=($ID==$ID_marca)?'selected' : '';
            $option.='<option value="'.$ID.'" '.$seleccion.'>'.$nombre.'</option>';
        }
    }
echo '<option value="">Seleccionar Marca</option>'.$option;
}
/** FRONTEND */ ////////////////////////////////////////////////////////////////////////////////////
function categorias(){
global $page_url,$tabla,$url_api;
$url_api=url_api();
$data = query_data($tabla, $url_api);
    if ($data != '' & $data != NULL) {
        $i = 0;
        foreach ($data as $row) {
            $i++;
            $cat[] = $row['cate'];
        }
        $res = array_unique($cat); //print_r($res);
        foreach ($res as $row => $dato) {
            $cate = str_replace('_', ' ', $dato);
            echo '<li data-filter="' . $dato . '"><a href="#">' . $cate . '</a></li>';
        }
    } else {
        echo '-';
    }
}

function productos(){
global $page_url,$mod,$tabla,$url_api;
$url_api=url_api();
sql_opciones('link_var', $valor);
$data = query_data($tabla, $url_api);
usort($data, function($b, $a){return strnatcmp($a['ID'], $b['ID']);}); //Orden por ID DESC
    if ($data != '' & $data != NULL) {
        $i = 0;
        foreach ($data as $row) {
            $i++;
            $visible = $row['visible'];
            if ($visible == 1) {
                $ID = $row['ID'];
                $cover = $row['cover'];
                $cate = str_replace('_', ' ', $row['cate']);
                $nom  = str_replace(' ', '-', $row['nombre']);
                if ($_GET['tema_previo'] != '') {$tema_p = '&tema_previo=' . $_GET['tema_previo'];}
                $link_zp = ($tema_p != '' || $valor == 1) ? $page_url . 'index.php?mod='.$mod.'&ext=item&id=' . $ID . $tema_p : $page_url . 'portafolio/item/' . $ID . '-' . $nom;
                echo '<!--[' . $i . '] -' . $ID . '-->
				<article class="portfolio portfolio-grid portfolio-col-4 ' . $row['cate'] . ' post-' . $i . ' type-portfolio status-publish has-post-thumbnail hentry portfolio_cat-' . $row['cate'] . '">
					<span class="entry-title" style="display: none;">' . $row['nombre'] . '</span><span class="vcard" style="display: none;"><span class="fn"><a href="#" title="Posts by Joe Doe" rel="author">Joe Doe</a></span></span><span class="updated" style="display:none">2016-06-17T10:06:56+00:00</span>
					<div class="portfolio-item default"> <a class="text-decoration-none portfolio-link" href="' . $link_zp . '"> <span class="thumb-info thumb-info-lighten"> <span class="thumb-info-wrapper"> <img class="img-responsive" width="367" height="367" src="' . $page_url . 'modulos/portafolio/fotos/' . $cover . '" alt="" /> <span class="thumb-info-title"> <span class="thumb-info-inner">' . $row['nombre'] . '</span> <span class="thumb-info-type">' . $cate . '</span> </span> <span class="thumb-info-action"> <span class="thumb-info-action-icon thumb-info-action-icon-primary"><i class="fa fa-link"></i></span> </span> </span> </span> </a></div>
				</article>
				';
            } //else{}
        }
        if ($ID == '') {
            echo '<div class="col-lg-12 col-xs-12" style="height:100px"><div class="alert alert-danger">Por el momento no hay proyectos visibles.</div><div class="alert alert-info">*Regrese más tarde.</div></div>' . "\n";
        }
    } else {
        echo '<div class="col-lg-12 col-xs-12" style="height:100px"><div class="alert alert-danger">Por el momento no hay proyectos.</div><div class="alert alert-info">*Regrese más tarde.</div></div>' . "\n";
    }
}

?>