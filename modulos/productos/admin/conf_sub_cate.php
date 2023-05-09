<?php
function table(){
    return $tabla='productos_sub_cate'; // TABLA
}

//Campos/Datos a utilizar
$campos = array(
    'cover',
    'subcategoria',
    'ord',
    'ID_cate',
    'descripcion'
);
//Mostrar tabla
$th = array(
    'ID_sub_cate'=>'ID',
    'Cover'=>'cover',
    'Nombre'=>'subcategoria',
    'Codi-Orden'=>'ord',
    'Categoría'=>'ID_cate',
    'Estado'=>'visible'
);
$tit_accion = 'SubCategoría'; //Titulo de accion
$imas = 0;  //Activar Agregado de Imagenes
$large = 0; //Activar Cards
$bmodal = 0; //Activar Modal
