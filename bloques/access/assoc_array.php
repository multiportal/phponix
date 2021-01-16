<?php
include '../../admin/conexion.php';

consulta_tabla_ID('config','ID=1',$row);//$re=print_r($row);

echo $row['page_name'];