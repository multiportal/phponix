<?php 

//Validación
function validacion_tabla($tabla){
global $mysqli,$DBprefix,$tabla,$bootstrap;
$mysqli=conexion();
    if($tabla!='signup' && $tabla!=NULL){
        $tabla = ($tabla==$DBprefix.'signup')?$tabla:$DBprefix.$tabla;        
        $sql = mysqli_query($mysqli,"DESCRIBE ".$tabla.";");
        if($sql){
            return $tabla;//$tabla=($tabla==$DBprefix.'signup')?$tabla:$DBprefix.$tabla;
        }else{
            echo $bootstrap.'<div class="alert alert-danger"><b>ERROR:</b> La Tabla no existe.<div>';exit();
        }
    }else{
        echo $bootstrap.'<div class="alert alert-warning"><b>PRECAUCIÓN:</b> No hay datos que mostrar<div>';exit();
    }
}
validacion_tabla($tabla);
//FUNCIONES CRUD
//Obtener campos para insert
function getCampos($input){
    $filterParams = [];
    foreach($input as $param => $value){
        $filterParams[] = "$param";
    }
    return implode(", ", $filterParams);
}

//Obtener valores para insert
function getValores($input){
    $filterParams = [];
    foreach($input as $param => $value){
        $filterParams[] = ":$param";
    }
    return implode(", ", $filterParams);
}

//Obtener parametros para updates
function getParams($input){
    $filterParams = [];
    foreach($input as $param => $value){
        $filterParams[] = "$param=:$param";
    }
    return implode(", ", $filterParams);
}

//Asociar todos los parametros a un sql
function bindAllValues($statement, $params){
	foreach($params as $param => $value){
		$statement->bindValue(':'.$param, $value);
	}
	return $statement;
}

//INDEX
function all(){
global $conec, $tabla;
    $sql = $conec->prepare("SELECT * FROM $tabla");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $data=$sql->fetchAll();//$data[]=$json;
    //mysqli_set_charset($conec, 'utf8');
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    echo json_encode($data);
}

//STORE
function store($id){
global $conec, $tabla;
    $sql = $conec->prepare("SELECT * FROM $tabla where ID=:id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    $json=$sql->fetch(PDO::FETCH_ASSOC);
    $data[]=$json;
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    echo json_encode($data);
}

//INSERT
function insert(){
global $conec,$tabla,$_POST;
    $input = $_POST;
    $campos = getCampos($input); //echo $campos;
    $valores = getValores($input); //echo $valores;
    $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";
    $statement = $conec->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $conec->lastInsertId();
    if($postId){
      //$input['id'] = $postId;
      header("HTTP/1.1 200 OK");
      header('Content-Type: application/json');
      echo json_encode($input);
    }    
}

//UPDATE
function update($id){
global $conec,$tabla,$_PUT;
    $input = $_PUT;
    $postId = $id; 
    $fields = getParams($input); //echo $fields;//exit();
    $sql = "UPDATE $tabla SET $fields WHERE ID='$postId'";
    $statement = $conec->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    echo json_encode($input);
}

//DELETE
function delete($id){
global $conec,$tabla;
    $statement = $conec->prepare("DELETE FROM $tabla where ID=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    $resultado['mensaje']='El registro '.$id.' ha sido eliminado.'; 
    echo json_encode($resultado);
}

//ERROR
function Error($error){
    header('Content-Type: application/json');
    $resultado['mensaje']=$error;
    echo json_encode($resultado);
}
//ERROR
$Error_id='No existe ID!';
$Error_msj ='';
?>