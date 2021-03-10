<?php
function table(){
    return $tabla='productos_cate'; // TABLA
}

//Campos/Datos a utilizar
$campos = array(
    'cover',
    'categoria',
    'ord',
    'descripcion'
);
//Mostrar tabla
$th = array(
    'ID'=>'ID',
    'Cover'=>'cover',
    'Nombre'=>'categoria',
    'Codi-Orden'=>'ord',
    'Estado'=>'visible'
);
$tit_accion = 'Categoría'; //Titulo de accion
$imas = 0;  //Activar Agregado de Imagenes
$large = 0; //Activar Cards
$bmodal = 0; //Activar Modal
