<?php

function listar_promos($carpeta){
global $page_url,$mod,$ext,$URL;
    if(is_dir($carpeta)){
        if($dir = opendir($carpeta)){
            while(($archivo = readdir($dir)) !== false){
                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != 'nodisponible.jpg' && $archivo != 'nodisponible1.jpg'){
					echo '<div class="promos"><a target="_blank" href="'.$page_url.$carpeta.$archivo.'"><img src="'.$page_url.$carpeta.$archivo.'" width="100%" alt="'.$archivo.'" title="'.$archivo.'" /></a></div>';
                }
            }
            closedir($dir);
        }
    }
}

function listar_promos2($carpeta){
global $page_url,$mod,$ext,$URL;
    if(is_dir($carpeta)){
        if($dir = opendir($carpeta)){
            while(($archivo = readdir($dir)) !== false){
                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != 'nodisponible.jpg' && $archivo != 'nodisponible1.jpg'){
                    echo '<div class="col-md-3 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                               <h3 class="box-title"></h3>
                            <span class="controles"> 
                                <button type="button" portaid="'.$archivo.'" class="btn btn-danger btnBorrar" title="Borrar"><i class="fa fa-trash"></i></button>
                            </span>
                        </div>
                        <div class="box-body">
                            <div class="ima-size">
                                <img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$archivo.'"  class="img-responsive ima-size">
                            </div>
                            <div id="title"><strong>' . $archivo . '</strong></div>	
                        </div><!-- /.box-body -->
                    </div>
                </div>';
                }
            }
            closedir($dir);
        }
    }
}
?>