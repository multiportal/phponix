<?php 
function table(){
    return $tabla='blog'; // TABLA
}

function url_api(){
global $page_url;
    $tabla=table();
    return $url_api=$page_url.'api/'.$tabla.'/';
}
//Campos/Datos a utilizar
$campos = array(
    'cover',
    'titulo',
    'descripcion',
    'contenido',
    'cate',
    'tag',
    'autor',
    'fmod',
    'fecha'
);
//Mostrar tabla
$th = array(
    'ID'=>'ID',
    'Cover'=>'cover',
    'Titulo'=>'titulo',
    'Categoría'=>'cate',
    'Autor'=>'autor',
    'Fecha Alta'=>'fecha',
    'Fecha Mod'=>'fmod',
    'Estado'=>'visible'
);
$tit_accion = 'Entrada'; //Titulo de accion
$imas = 0;  //Activar Agregado de Imagenes
$large = 1; //Activar Cards
$bmodal = 0; //Activar Modal

$btn_modal=($bmodal==1)?'data-toggle="modal" data-target="#modalForm"':'';
$tabla=table();
$url_api=url_api();
//ajaxCrud($large,$campos,$imas=1,$tinyMCE=1);
//ajaxCrud($large,$campos,$th,$imas,1);
/** BACKEND */ ////////////////////////////////////////////////////////////////////////////////////
function html_iso(&$titulo,&$des,&$tag,&$autor){
global $chartset;
 if($chartset=='iso-8859-1'){
	$titulo=htmlentities($titulo, ENT_COMPAT,'ISO-8859-1', true);
	$des = htmlentities($des, ENT_COMPAT,'ISO-8859-1', true);
	$tag = htmlentities($tag, ENT_COMPAT,'ISO-8859-1', true);	
	$autor=htmlentities($autor, ENT_COMPAT,'ISO-8859-1', true);
 }else{
    $titulo=htmlentities($titulo);
	$des = htmlentities($des);
	$tag = htmlentities($tag);	
	$autor=htmlentities($autor);
 }
}
/** FRONTEND */ ////////////////////////////////////////////////////////////////////////////////////
function blog(){
global $page_url,$mod,$tabla,$url_api;
$url_api=url_api();
$topic='topic';
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
                $titulo = $row['titulo'];
                $titulo1 = str_replace(' ', '-', $titulo);
                $cate = $row['cate'];
                $tag = $row['tag'];
                $des = $row['descripcion'];
                $autor = $row['autor'];
                $fecha = $row['fecha'];

                if ($_GET['tema_previo'] != '') {$tema_p = '&tema_previo=' . $_GET['tema_previo'];}
                $link_zp = ($tema_p != '' || $valor == 1) ? $page_url . 'index.php?mod='.$mod.'&ext='.$topic.'&id=' . $ID . $tema_p : $page_url.$mod.'/'.$topic.'/' . $ID . '-' . $titulo1;
                echo '<!--[' . $i . '] -' . $ID . '-->
                <div class="col-lg-4 col-xs-12 h-item">
                    <div class="titb"><h3><strong>'.$titulo.'</strong></h3></div>
                    <p class="new-font"><!--span class="glyphicon glyphicon-calendar" aria-hidden="true"></span--> <a href="'.$link_zp.'" class="fontB">'.$fecha.'</a> por <a href="" class="fontB">'.$autor.'</a></p>
                    <img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$cover.'" alt="'.$tag.'" class="img-resp">
                    <!--div class="div-clear"><p>&nbsp;</p></div-->
                    <div class="new-font2">'.$des.'</div>
                    <!--div class="div-clear"><p>&nbsp;</p></div-->
                    <div class="text-right"><a href="'.$link_zp.'" class="btn_azul">Ver Más</a></div>
                    <!--div class="div-clear"><p>&nbsp;</p></div-->
                </div>
                ';
            }
        }
        if ($ID == '' || $ID == NULL) {
            echo '<div class="col-lg-12 col-xs-12" style="height:100px"><div class="alert alert-danger">Por el momento no hay proyectos visibles.</div><div class="alert alert-info">*Regrese más tarde.</div></div>' . "\n";
        }
    } else {
        echo '<div class="col-lg-12 col-xs-12" style="height:100px"><div class="alert alert-danger">Por el momento no hay proyectos.</div><div class="alert alert-info">*Regrese más tarde.</div></div>' . "\n";
    }
}


function sidebar_blog(){
global $page_url,$mod,$tabla,$url_api;
$url_api=url_api();
$topic='topic';
sql_opciones('link_var', $valor);
$data = query_data($tabla, $url_api);
usort($data, function($b, $a){return strnatcmp($a['ID'], $b['ID']);}); //Orden por ID DESC
    if ($data != '' & $data != NULL) {
        $i = 0;
        foreach ($data as $row) {
            $i++;
            $visible = $row['visible'];
            if ($visible == 1 && $i<=5) {
                $ID = $row['ID'];
                $cover = $row['cover'];
                $titulo = $row['titulo'];
                $titulo1 = str_replace(' ', '-', $titulo);
                $cate = $row['cate'];
                $fecha = $row['fecha'];

                if ($_GET['tema_previo'] != '') {$tema_p = '&tema_previo=' . $_GET['tema_previo'];}
                $link_zp = ($tema_p != '' || $valor == 1) ? $page_url . 'index.php?mod='.$mod.'&ext='.$topic.'&id=' . $ID . $tema_p : $page_url.$mod.'/'.$topic.'/' . $ID . '-' . $titulo1;
                echo '<!--[' . $i . '] -' . $ID . '-->
                <li>
                    <a href="'.$link_zp.'">'.$titulo.'</a>
                    <span class="post-date">'.$fecha.'</span>
                </li>
                ';
            }
        }
        if ($ID == '' || $ID == NULL) {
            echo '<div class="col-lg-12 col-xs-12" style="height:100px"><div class="alert alert-danger">Por el momento no hay proyectos visibles.</div></div>' . "\n";
        }
    } else {
        echo '<div class="col-lg-12 col-xs-12" style="height:100px"><div class="alert alert-danger">Por el momento no hay proyectos.</div></div>' . "\n";
    }
}

function one_blog(){
global $page_url,$mod,$tabla,$url_api,$id;
$tabla=table();
$row = query_row($tabla,'ID',$id);
    if($row){
		$cover=$row['cover'];
		$titulo=$row['titulo'];
		$descripcion=$row['descripcion'];
		$contenido=$row['contenido'];
		$tag=$row['tag'];
		$autor=$row['autor'];
        $fecha=$row['fecha'];
        
        echo '<div>'.$titulo.'</div>';
    } else {
        echo '<div>'.$mod.'|'.$tabla.'|'.$id.'|'.$titulo.'</div>';
        echo '<div class="col-lg-12 col-xs-12" style="height:100px"><div class="alert alert-danger">Entrada no encontrada regrese m&aacute;s tarde. '.$back.'</div></div>' . "\n";
    }
}
?>