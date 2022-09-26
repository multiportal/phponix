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
$bootstrap =($ex_scfg==1)?$bootstrap:'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">';
//$mysqli=conexion();
    if($tabla!='signup' && $tabla!='token' && $tabla!=NULL){
        $tabla = ($tabla=='_signup' || $tabla=='_token')?str_replace('_','',$tabla):$tabla;           
        $tabla = $DBprefix.$tabla;
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
        //}
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
function storeAll($id){
global $conec, $tabla, $IdT, $tokenCookie, $sel_apiType, $sel_sesionToken;
    $q = ($id) ? " WHERE ".$IdT."=?":"";
    $sql = $conec->prepare("SELECT * FROM ".$tabla.$q);
    ($id)?$sql->execute([$id]):$sql->execute();
    $tot = $sql->rowCount();
    if($sql){
        if($tot > 0){
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $data = $sql->fetchAll();//$data[]=$json;
        }else{
            if($id > 0){
                Error('Registro no encontrado.');exit();
            }
        }
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
        $page = array("total_count"=>$tot,"page"=>1,"page_size"=> 1);//Calcular
        if($sel_apiType=='restfull'){
        $res['apiType'] = $sel_apiType;
            $res['Token'] = $_COOKIE['token'];
        }
        $res['metadata']=$meta;
        $res['data']=$data;
        $res['pagination']=$page;
        echo json_encode($res);    
    }
}

function storeAllToken($id){
global $id, $tokenCookie, $sel_apiType, $sel_sesionToken;
    $validar = verificarToken($tokenCookie);
    if($validar!=NULL && $sel_apiType=='restfull'){
        storeAll($id);
    }else{
        Error('ERROR 401: La sesión a caducado'); 
    }
}

function all(){
global $conec, $tabla, $sel_apiType, $sel_sesionToken;
    $sql = $conec->prepare("SELECT * FROM $tabla");
    $sql->execute();
    $tot = $sql->rowCount();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $data = $sql->fetchAll();//$data[]=$json;
    //mysqli_set_charset($conec, 'utf8');
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
    $page = array("total_count"=>$tot,"page"=>1,"page_size"=> 1);//Calcular
    if($sel_apiType=='restfull'){
        $res['apiType'] = $sel_apiType;
        $res['Token'] = $_COOKIE['token'];
    }
    $res['metadata']=$meta;
    $res['data']=$data;
    $res['pagination']=$page;
    echo json_encode($res);
}

function allToken(){
global $tokenCookie, $sel_apiType, $sel_sesionToken;
    $validar = verificarToken($tokenCookie);
    if($validar!=NULL && $sel_apiType=='restfull'){
        all();
    }else{
        Error('ERROR 401: La sesión a caducado'); 
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
    $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
    //$page = array("total_count"=>1,"page"=>1,"page_size"=> 1);
    if($sel_apiType=='restfull'){
        $res['metadata']=$meta;
        $res['data']=$data;
        $res['apiType'] = $sel_apiType;
        $res['Token'] = $_COOKIE['token'];
        echo json_encode($res);
    }else{
        $res['metadata']=$meta;
        $res['data']=$data;
        echo json_encode($res);
    }
}

function storeToken($id){
global $id, $tokenCookie, $sel_apiType, $sel_sesionToken;
    $validar = verificarToken($tokenCookie);
    if($validar!=NULL && $sel_apiType=='restfull'){
        store($id);
    }else{
        Error('ERROR 401: La sesión a caducado'); 
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
          $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
          echo json_encode($input);
        }
    }else{
        Error('ERROR 401: La sesión a caducado');
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
        $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
        echo json_encode($input);
    }else{
        Error('ERROR 401: La sesión a caducado');
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
        $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
        $resultado['mensaje']='El registro '.$id.' ha sido eliminado.'; 
        echo json_encode($resultado);
    }else{
        Error('ERROR 401: La sesión a caducado');
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
            $tok->execute();//$n=$tok->rowCount();
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
                $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
                $resultado['IDU']=$ID;
                //$resultado['mensaje']='OK';
                $resultado['token']=$token;
                $resultado['VerifcarToken']=verificarToken($token);
                $res['metadata']=$meta;
                $res['data']=$resultado;
                echo json_encode($res);
            }
        }else{
            Error('ERROR: El usuario o password es incorrecto');
        }
    }else{Error('ERROR: El usuario o password es incorrecto');}
}

//PROFILE
function profile(){
global $conec,$tab_signup;
    $token = $_POST['token'];
    $validar = verificarToken($token);
    $ID=$validar['ID_user'];
    $sql = $conec->prepare("SELECT * FROM $tab_signup WHERE ID=:ID");//Limit Info
    $sql->bindValue(':ID', $ID);
    $sql->execute();
    $json=$sql->fetch(PDO::FETCH_ASSOC);
    if($json){
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
        $resultado['InfoToken']=$validar;
        $resultado['InfoUser']=$json;
        $res['metadata']=$meta;
        $res['data']=$resultado; 
        echo json_encode($res);    
    }else{Error('ERROR: El usuario es incorrecto');}
}

function fileUpload(){
global $page_url,$conec,$table,$tab_signup;

    $email = (isset($_GET['email'])) ? $_GET['email'] : '';
    $token = $_POST['token'];
    $validar = verificarToken($token);
    $ID=$validar['ID_user'];
    $sql = $conec->prepare("SELECT * FROM $tab_signup WHERE ID=:ID OR email=:email");//Limit Info
    $sql->bindValue(':ID', $ID);
    $sql->bindValue(':email', $email);
    $sql->execute();
    $json=$sql->fetch(PDO::FETCH_ASSOC);
    if($json){
        $type = (isset($_GET['type'])) ? $_GET['type'] : '';
        $saveDB = (isset($_GET['save'])) ? $_GET['save'] : '';
        $imgUrl = './../file/images/nodisponible1.jpg';
        $msg_box = '';
        //datos del arhivo 
        $repositor = ($type == 'images')?'file/images':'file/docs';
        $nombre_archivo = $_FILES['file-upload']['name'];
        $tipo_archivo = $_FILES['file-upload']['type'];
        $tamano_archivo = $_FILES['file-upload']['size'];
        $filec = $_FILES['file-upload']['tmp_name'];
        $path_archivo = $repositor . "/" . $nombre_archivo;
        //Config del archivo
        $limite_file = 1; //MB
        $lim = $limite_file * 1024 * 1024;
        $validExt = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
        $fileExtension = explode('.', $nombre_archivo);
        $fileExtension = strtolower(end($fileExtension));
        $typeF = ($type == 'images') ? 'la imagen':'el archivo';

        //compruebo si las características del archivo son las que deseo 
	    if (!in_array($fileExtension, $validExt) || ($tamano_archivo > $lim)) {
		    $class = 'alert-danger';
		    $status = 'Error';
		    $msg = $typeF.' NO ha sido aceptada.';
	    } else {
            //Compruebo donde se va guardar en el servidor o en DB
            if($saveDB == 1 || $saveDB == 2){
                $fileContenido = addslashes(file_get_contents($filec));//*Solo permite procesar un 1MB.
                //Insertar imagen en la base de datos
                $insertar = "INSERT INTO upload_files (nombre, type_file, filec, created_at) VALUES ('$nombre_archivo', '$tipo_archivo', '$fileContenido', now())";
                $insertar = $conec->prepare($insertar);
                $insertar->execute();
		        // Condicional para verificar la subida del fichero
                if($insertar){
                    $class = 'alert-success';
                    $status = 'Correcto';
                    $msg = $typeF.' se guardo correctamente.';
                    //Extraer imagen de la BD mediante GET
                    $sql = $conec->prepare("SELECT * FROM upload_files WHERE nombre=:nombre");
                    $sql->bindValue(':nombre', $nombre_archivo);
                    $sql->execute();
                    $numRows = $sql->rowCount();                      
                    if($numRows > 0){
                        $row=$sql->fetch(PDO::FETCH_ASSOC);
                        $imgUrl = 'data:'.$tipo_archivo.';base64,' . base64_encode($row['filec']);
                        //$imgUrl = strval($page_url.'api/upload/blob.php?id='.$row['ID']);
                    }
                }else{
                    $class = 'alert-danger';
                    $status = 'Error';
                    $msg = 'Ocurrio algun error al guardar '.$typeF.'. Intentelo nuevamente.';
                } 
            }

            if($saveDB == '' || $saveDB == 0 || $saveDB == 2){
                if (@move_uploaded_file($filec, $path_archivo)) {
                    $class = 'alert-success';
                    $status = 'Correcto';
                    $msg = $typeF.' se subio correctamente.';
                    $imgUrl = $page_url.'api/upload/'.$path_archivo;
                } else {
                    $class = 'alert-danger';
                    $status = 'Error';
                    $msg = 'Ocurrio algun error al subir '.$typeF.'. Intentelo nuevamente.';
                }
            }
	    }

        $msg_box = '
        <div class="alert ' . $class . ' alert-dismissible fade show" role="alert">
            <strong>' . $status . ':</strong> ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';    
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        $meta = array("status" => "success", "http_code" => 200, "date_time" => date('c'), "message" => "ok");
        $resultado['status'] = $status;
        $resultado['mensaje'] = $msg;
        $resultado['html'] = $msg_box;
        $resultado['name'] = $nombre_archivo;
        $resultado['url'] = $imgUrl;
        $res['metadata'] = $meta;
        $res['data'] = $resultado;
        echo json_encode($res);
    }else{Error('El usuario es incorrecto');}
}

/*************************************/
function tableUploadFiles($id){
global $conec,$page_url;
    $data = [];$imgUrl = '';
    $q = ($id) ? " WHERE ID=?":"";
    $sql = $conec->prepare("SELECT * FROM upload_files".$q);
    ($id)?$sql->execute([$id]):$sql->execute();
    $tot = $sql->rowCount();
    if($sql){
        if($tot > 0){$i = -1;// hidden array num
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $key) {$i++;
                $ID=$key['ID'];
                foreach($key as $campo=>$value){
                    if($campo=='filec'){
                        $imgUrl= strval($page_url.'api/upload/blob.php?id='.$ID);
                        $d[$i][$campo] = $imgUrl;
                    }else{
                        $d[$i][$campo] = $value;
                    }
                }
            }
            $data = $d;
            //$data = array("ID"=>$row['ID'],"nombre"=>$row['nombre'],"type_file"=>$row['type_file'],"filec"=>"","created_at"=>$row['created_at']);
        }
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');        
        $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
        $page = array("total_count"=>$tot,"page"=>1,"page_size"=> 1);//Calcular
        $res['metadata']=$meta;
        $res['data']=$data;
        $res['pagination']=$page;
        echo json_encode($res);
    }else{Error('Error');}
}

function blobImage($q){
global $conec,$bootstrap,$ex_scfg;
    $bootstrap =($ex_scfg==1)?$bootstrap:'<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">';
    //Extraer imagen de la BD mediante GET
    $sql = $conec->prepare("SELECT * FROM upload_files WHERE ID=:ID OR nombre=:ID");
    $sql->bindValue(':ID', $q);
    $sql->execute();
    $numRows = $sql->rowCount();                      
    if($numRows > 0){
        $row=$sql->fetch(PDO::FETCH_ASSOC);
        $imgUrl = $row['filec'];
        //Mostrar Imagen
        header("Content-type: ".$row['type_file']); 
        echo $imgUrl;
    }else{
        echo $bootstrap.'<div class="alert alert-danger"><b>ERROR:</b> El archivo no existe.<div>';
    }
}
/*************************************/

//ERROR
function Error($error){
global $tabla;
    $msg = $error;
    $status = 'Error';
    $msg_box = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>' . $status . ':</strong> ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    $meta = array("status" => "error", "http_code" => 200, "date_time" => date('c'), "message" => "bad");
    $resultado['status'] = $status;
    $resultado['mensaje'] = $msg;
    $resultado['html'] = $msg_box;
    if($tabla == 'upload_files'){
        $resultado['name'] = '';
        $resultado['url'] = '';    
    }
    $res['metadata'] = $meta;
    $res['data'] = $resultado;
    echo json_encode($res);//echo json_encode($resultado);
}

function message($msg){
    $status = 'Correcto';
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    $meta = array("status"=>"success","http_code"=> 200,"date_time"=>date('c'),"message"=> "ok");
    $resultado['status'] = $status;
    $resultado['mensaje'] = $msg;
    //$resultado['html'] = $msg_box;
    //$resultado['name'] = '';
    //$resultado['url'] = '';
    $res['metadata'] = $meta;
    $res['data'] = $resultado;
    echo json_encode($res);//echo json_encode($resultado);
}

//message('mensaje','GET','Error','code');

//MENSAJES
$msj_test='Mensaje de prueba';
$msj_ok='ok';
$msj_login='Usted esta en el Login';
$msj_profile='Usted esta en el Profile';
$msj_upload='Usted esta en el upload';
//ERROR
$Error_id='No existe ID!';
$Error_msj ='La consulta no se ejecuto';
