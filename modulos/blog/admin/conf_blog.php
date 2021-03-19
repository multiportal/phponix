<?php
function table(){
    return $tabla='blog'; // TABLA
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