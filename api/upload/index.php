<?php 
include_once '../v2/includes/conexion.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
//header('Content-Type: text/html; charset=utf-8');
//header('Content-Type: multipart/form-data');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

//header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //$_POST = json_decode(file_get_contents('php://input'),true);
    fileUpload();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    message($msj_upload);
}

//echo json_encode($resultado);
?>