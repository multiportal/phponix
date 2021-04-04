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
function bindAllValues($sql, $params){
	foreach($params as $param => $value){
		$sql->bindValue(':'.$param, $value);
	}
	return $sql;
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
global $conec, $tabla, $IdT;
    $sql = $conec->prepare("SELECT * FROM $tabla where $IdT=:id");
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
    $sql = $conec->prepare($sql);
    bindAllValues($sql, $input);
    $sql->execute();
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
global $conec,$tabla,$_PUT,$IdT;
    $input = $_PUT;
    $postId = $id; 
    $fields = getParams($input); //echo $fields;//exit();
    $sql = "UPDATE $tabla SET $fields WHERE $IdT='$postId'";
    $sql = $conec->prepare($sql);
    bindAllValues($sql, $input);
    $sql->execute();
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    echo json_encode($input);
}

//DELETE
function delete($id){
global $conec,$tabla,$IdT;
    $sql = $conec->prepare("DELETE FROM $tabla where $IdT=:id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    $resultado['mensaje']='El registro '.$id.' ha sido eliminado.'; 
    echo json_encode($resultado);
}

//LOGIN
function login(){
global $conec,$DBprefix,$date,$_POST;
    $tabla='signup';
    $U=(isset($_POST['username']))?$_POST['username']:'';
    $P=(isset($_POST['password']))?$_POST['password']:'';
    $input=$_POST;
    $login = htmlspecialchars(trim($U));
    $pass = trim($P);
    $pass1 = ($pass=='123456')?$pass:sha1(md5($pass));// Encriptamos "Ciframos" el password
    
    $sql = $conec->prepare("SELECT * FROM $DBprefix$tabla WHERE username=:username && password=:password");
    $sql->bindValue(':username', $U);
    $sql->bindValue(':password', $pass1);
    $sql->execute();
    $sesid=$sql->fetch(PDO::FETCH_ASSOC);
    $ID = $sesid['ID'];
    $us = $sesid['username'];
    $pa = $sesid['password'];
    if($us==$U || $pa==$P){
        $tabla='token';
        $token = sha1(uniqid(rand(),true));//Generador de Token //Token();
        $tok = "INSERT INTO $DBprefix$tabla (ID_user,Token,Estado,Fecha) VALUES ('{$ID}','{$token}','Activo','{$date}')";
        $tok = $conec->prepare($tok);
        $tok->execute();
        if($tok){
            $sqlt = $conec->prepare("SELECT * FROM $DBprefix$tabla WHERE ID_user=:ID_user && Estado='Activo' ORDER BY ID DESC");
            $sqlt->bindValue(':ID_user', $ID);
            $sqlt->execute();
            $json=$sqlt->fetch(PDO::FETCH_ASSOC);
            $data[]=$json;
            $token=$json['Token'];
            setcookie("token",$token,time()+(60+60+24+31),"/");
            header("HTTP/1.1 200 OK");
            header('Content-Type: application/json');
            $resultado['IDU']=$ID;
            $resultado['mensaje']='OK';
            $resultado['token']=$token;
            echo json_encode($resultado);
        }
    }else{
        Error('ERROR: El usuario o password es incorrecto');
    }
}

//ERROR
function Error($error){
    header('Content-Type: application/json');
    $resultado['mensaje']=$error;
    echo json_encode($resultado);
}
//MENSAJES
$msj_test='Mensaje de prueba';
$msj_ok='ok';
$msj_login='Usted esta en el Login';
//ERROR
$Error_id='No existe ID!';
$Error_msj ='La consulta no se ejecuto';
?>