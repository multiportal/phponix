<?php 
include_once 'includes/conexion.php';
validacion_tabla($tabla);
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
//header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

//header('Content-Type: application/json');
switch ($_SERVER['REQUEST_METHOD']) {
  case 'POST':
    $_POST = json_decode(file_get_contents('php://input'),true);
    insert();
  break;
  case 'GET':
    if($id){
      store($id);
    }else{
      all();
    }
  break;
  case 'PUT':
    $_PUT = json_decode(file_get_contents('php://input'),true);
    if(isset($_GET['id'])){
      update($id);
    }else{
      Error($Error_id);
    }
  break;
  case 'DELETE':
    $_DEL = json_decode(file_get_contents('php://input'),true);
    if(isset($_GET['id'])){
      delete($id);
    }else{
      Error($Error_id);
    }
  break;
}

//echo json_encode($resultado);
?>