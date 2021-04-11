<?php
include_once 'rest/functions.php';

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
//header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

//GET
if($_SERVER['REQUEST_METHOD']=='GET'){//Código del metodo rest echo '<div>ok['.$tabla.'/'.$id.']</div>';
  if($id!=''){
    //Mostrar un registro
    store($id);exit();
  }else{
    //Mostrar lista de registros
    all();exit();
  }
}

//POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if($id!=''){
    // Actualizar post
    update($id);exit();
  }else{
    // Crear un nuevo post
    insert();exit();
  } 
}

//DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
  delete($id);exit();
}

//Actualizar
if($_SERVER['REQUEST_METHOD'] == 'PUT'){
  $input = $_GET; //print_r($input);
  $postId = $_GET['id']; //echo $postId;
  $fields = getParams($input); //echo $fields;//exit();
  $sql = "UPDATE $tabla SET $fields WHERE ID='$postId'";
  $statement = $conec->prepare($sql);
  bindAllValues($statement, $input);
  $statement->execute();
  header("HTTP/1.1 200 OK");
  echo json_encode($input);
  exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
?>