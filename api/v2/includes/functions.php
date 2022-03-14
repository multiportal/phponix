<?php 
//Campo ID
function Identificador(){
global $tabla;
    switch ($tabla) {
        case ($tabla=='citas'):
            $ID='CitaId';
        break;
        case ($tabla=='pacientes'):
            $ID='PacienteId';
        break;
        case ($tabla=='usuarios'):
            $ID='UsuarioId';
        break;
        case ($tabla=='usuarios_token'):
            $ID='TokenId';
        break;
        default:
            $ID='ID';
        break;
    }
    return $ID;
}
$IdT=Identificador();

//Validación
function validacion_tabla($tabla){
global $conec,$DBprefix,$tabla,$bootstrap,$ex_scfg;
//$mysqli=conexion();
    if($tabla!='signup' && $tabla!='token' && $tabla!=NULL){
        $tabla = ($tabla=='_signup' || $tabla=='_token' && $ex_scfg!=1)?str_replace('_','',$tabla):$tabla;           
        $tabla = ($tabla==$DBprefix.'signup' || $tabla==$DBprefix.'token')?$tabla:$DBprefix.$tabla;
        $sql = "SELECT * FROM ".$tabla.";";//$sql = mysqli_query($mysqli,"DESCRIBE ".$tabla.";");
        try {
            $result = $conec->query($sql);
        } catch (Exception $e) {
            $result = FALSE;    // We got an exception == table not found
        }
        if($result){
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

//Reformater Array
function formatearPost($key){
    foreach($key as $row => $dato){
        if($row!='token'){
            $input[$row]=$dato;
        }
    }
    return $input;
}

//Verificar Token
function verificarToken($token){
global $conec,$tab_token;
    $sql = $conec->prepare("SELECT * FROM $tab_token WHERE Token=:token AND Estado='Activo' ORDER BY ID DESC");
    $sql->bindValue(':token', $token);
    $sql->execute();
    $json=$sql->fetch(PDO::FETCH_ASSOC);
    return $json;
}

//Check UserId Token
function verificarUserToken($id){
global $conec,$tab_token;
    $sql = $conec->prepare("SELECT * FROM $tab_token WHERE ID_user=:id AND Estado='Activo' ORDER BY ID DESC");
    $sql->bindValue(':id', $id);
    $sql->execute();
    $json=$sql->fetch(PDO::FETCH_ASSOC);
    return $json['Estado'];
}

//INDEX
function all(){
global $conec, $tabla, $sel_apiType, $sel_sesionToken;
    $sql = $conec->prepare("SELECT * FROM $tabla");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $data=$sql->fetchAll();//$data[]=$json;
    //mysqli_set_charset($conec, 'utf8');
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    if($sel_apiType=='restfull'){
        $res['data'] = $data;
        $res['apiType'] = $sel_apiType;
        $res['Token'] = $_COOKIE['token'];
        echo json_encode($res);
    }else{
        echo json_encode($data);
    }
}

function allToken(){
global $tokenCookie, $sel_apiType, $sel_sesionToken;
    $validar = verificarToken($tokenCookie);
    if($validar!=NULL && $sel_apiType=='restfull'){
        all();
    }else{
        Error('ERROR: La sesión a caducado'); 
    }
}

//STORE
function store($id){
global $conec, $tabla, $IdT, $tokenCookie, $sel_apiType, $sel_sesionToken;
    $sql = $conec->prepare("SELECT * FROM $tabla WHERE $IdT=:id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    $json=$sql->fetch(PDO::FETCH_ASSOC);
    $data[]=$json;
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    if($sel_apiType=='restfull'){
        $res['data'] = $data;
        $res['apiType'] = $sel_apiType;
        $res['Token'] = $_COOKIE['token'];
        echo json_encode($res);
    }else{
        echo json_encode($data);
    }
}

function storeToken($id){
global $id, $tokenCookie, $sel_apiType, $sel_sesionToken;
    $validar = verificarToken($tokenCookie);
    if($validar!=NULL && $sel_apiType=='restfull'){
        store($id);
    }else{
        Error('ERROR: La sesión a caducado'); 
    }
}

//INSERT
function insert(){
global $conec,$tabla,$_POST;
    $token = $_POST['token'];
    $input = formatearPost($_POST);
    $validar = verificarToken($token);
    if($validar!=NULL){        
        $campos = getCampos($input); //echo $campos;
        $valores = getValores($input); //echo $valores;
        $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";
        $sql = $conec->prepare($sql);
        bindAllValues($sql, $input);
        $sql->execute();
        $postId = $conec->lastInsertId();
        if($postId){
          $input['id'] = $postId; //$input['token'] = $token;
          header("HTTP/1.1 200 OK");
          header('Content-Type: application/json');
          echo json_encode($input);
        }
    }else{
        Error('ERROR: La sesión a caducado');
    }    
}

//UPDATE
function update($id){
global $conec,$tabla,$_PUT,$IdT;
    $postId = $id; 
    $token = $_PUT['token'];
    $input = formatearPost($_PUT);
    $validar = verificarToken($token);
    if($validar!=NULL){
        $fields = getParams($input); //echo $fields;//exit();
        $sql = "UPDATE $tabla SET $fields WHERE $IdT='$postId'";
        $sql = $conec->prepare($sql);
        bindAllValues($sql, $input);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        echo json_encode($input);
    }else{
        Error('ERROR: La sesión a caducado');
    }    
}

//DELETE
function delete($id){
global $conec,$tabla,$_DEL,$IdT;
    $token = $_DEL['token'];
    $validar = verificarToken($token);
    if($validar!=NULL){
        $sql = $conec->prepare("DELETE FROM $tabla where $IdT=:id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        $resultado['mensaje']='El registro '.$id.' ha sido eliminado.'; 
        echo json_encode($resultado);
    }else{
        Error('ERROR: La sesión a caducado');
    }
}

//LOGIN
function login(){
global $conec,$DBprefix,$tab_signup,$tab_token,$date,$_POST,$dbSQLite;
    $U=(isset($_POST['username']))?$_POST['username']:'';
    $P=(isset($_POST['password']))?$_POST['password']:'';
    $input=$_POST;
    $login = htmlspecialchars(trim($U));
    $pass = trim($P);
    $pass1 = ($pass=='123456')?$pass:sha1(md5($pass));// Encriptamos "Ciframos" el password
    if($dbSQLite!=''){
        $sql = $conec->prepare("SELECT * FROM $tab_signup WHERE username=? AND password=?");
        $sql->execute([$login, $pass1]);
    }else{
        $sql = $conec->prepare("SELECT * FROM $tab_signup WHERE username=:username AND password=:password");
        $sql->bindValue(':username', $login, PDO::PARAM_STR);
        $sql->bindValue(':password', $pass1, PDO::PARAM_STR);
        $sql->execute();
    }
    $sesid=$sql->fetch(PDO::FETCH_ASSOC);
    $ID = $sesid['ID'];
    $us = $sesid['username'];
    $pa = $sesid['password'];
    if($ID!=NULL && $ID!=''){
        if($us==$U || $pa==$P){
            $token = sha1(uniqid(rand(),true));//Generador de Token //Token();
            $tok = "INSERT INTO $tab_token (ID_user,Token,Estado,Fecha) VALUES ('{$ID}','{$token}','Activo','{$date}')";
            $tok = $conec->prepare($tok);
            $tok->execute();
            if($tok){
                if($dbSQLite!=''){
                    $sqlt = $conec->prepare("SELECT * FROM $tab_token WHERE ID_user=? AND Estado='Activo' ORDER BY ID DESC");
                    $sqlt->execute([$ID]);
                }else{
                    $sqlt = $conec->prepare("SELECT * FROM $tab_token WHERE ID_user=:ID_user AND Estado='Activo' ORDER BY ID DESC");
                    $sqlt->bindValue(':ID_user', $ID);
                    $sqlt->execute();
                }
                $json=$sqlt->fetch(PDO::FETCH_ASSOC);
                $data[]=$json;
                $token=$json['Token'];
                setcookie("token",$token,time()+(60+60+24+31),"/");
                setcookie("username",$us,time()+(60+60+24+31),"/");
                setcookie("password",$pass,time()+(60+60+24+31),"/");
                header("HTTP/1.1 200 OK");
                header('Content-Type: application/json');
                $resultado['IDU']=$ID;
                $resultado['mensaje']='OK';
                $resultado['token']=$token;
                $resultado['VerifcarToken']=verificarToken($token);
                echo json_encode($resultado);
            }
        }else{
            Error('ERROR: El usuario o password es incorrecto');
        }
    }else{Error('ERROR 400: Mala Respuesta');}
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