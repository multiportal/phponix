<?php 
function table(){
    return $tabla='productos'; // TABLA
}

function url_api(){
global $page_url;
    $tabla=table();
    return $url_api=$page_url.'api/'.$tabla.'/';
}
//Campos/Datos a utilizar
$campos = array(
    'clave',
    'nombre',
    'cover',
    'FT',
    'cate',
    'resena',
    'descripcion',
    'precio',
    'url_page',
    'alta',
    'fmod',
    'user'
);
//Mostrar tabla
$th = array(
    'ID'=>'ID',
    'Cover'=>'cover',
    'Nombre'=>'nombre',
    'Categoría'=>'cate',
    'Fecha Termino'=>'FT',
    'Estado'=>'visible'
);
$tit_accion = 'Portafolio'; //Titulo de accion
$imas = 1;  //Activar Agregado de Imagenes
$large = 1; //Activar Cards
$bmodal = 0; //Activar Modal

$btn_modal=($bmodal==1)?'data-toggle="modal" data-target="#modalForm"':'';
$tabla=table();
$url_api=url_api();
/** BACKEND */ ////////////////////////////////////////////////////////////////////////////////////

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

function portafolio(){
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