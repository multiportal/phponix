<?php
function table(){
    return $tabla='productos'; // TABLA
}

//Campos/Datos a utilizar
$campos = array(
    'codigo',
    'clave',
    'nombre',
    'cover',
    'descripcion',
    'marca',
    'modelo',
    'tipo',
    'precio',
    'moneda',
    'unidad',
    'peso',
    'color',
    'medidas',
    'stock',
    'serie',
    'lote',
    'ID_cate',
    'ID_sub_cate',
    'ID_sub_cate2',
    'ID_marca',
    'url_name',
    'cate',
    'resena',
    'nuevo',
    'promo',
    'descuento',
    'clasificacion',
    'tags',
    'land',
    'file',
    'alta',
    'fmod',
    'user'
);
//Mostrar tabla
$th = array(
    'ID'=>'ID',
    'Cover'=>'cover',
    'Nombre'=>'nombre',
    'ID_Cate'=>'ID_cate',
    'Categoría'=>'cate',
    'Precio'=>'precio',
    'Moneda'=>'moneda',
    'Unidad'=>'unidad',
    'Stock'=>'stock',
    'Estado'=>'visible'
);
$tit_accion = 'Producto'; //Titulo de accion
$imas = 1;  //Activar Agregado de Imagenes
$large = 1; //Activar Cards
$bmodal = 0; //Activar Modal
