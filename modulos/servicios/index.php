<?php
include 'admin/functions.php';
pages($mod,$ext,$contenido,$activo);
if($activo==1){echo $contenido;}else{
 header('Location: '.$page_url); //servicios(); 
}?>