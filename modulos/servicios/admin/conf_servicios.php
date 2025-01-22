<?php
function table(){
    return $tabla='servicios'; // TABLA
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
    'Precio'=>'precio',
    'Estado'=>'visible'
);
$tit_accion = 'Servicio'; //Titulo de accion
$imas = 1;  //Activar Agregado de Imagenes
$large = 1; //Activar Cards
$bmodal = 0; //Activar Modal
