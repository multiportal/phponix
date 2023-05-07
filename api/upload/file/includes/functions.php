<?php

function fileUpload(){
    $host = $_SERVER['HTTP_HOST']; //Nombre del dominio (dominio.com).
    $dominio = ($host == 'localhost') ? 'http://' . $host . '/' : 'https://' . $host . '/';
    $path_root = 'MisSitios/apirestm/';
    $page_url = $dominio . $path_root;

    $type = (isset($_GET['type'])) ? $_GET['type'] : '';
    $saveDB = (isset($_GET['save'])) ? $_GET['save'] : '';
    $imgUrl = 'api/upload/file/images/nodisponible1.jpg';
    $msg_box = '';
    //datos del arhivo 
    $repositor = ($type == 'images') ? 'file/images' : 'file/docs';
    $nombre_archivo = $_FILES['file']['name'];
    $tipo_archivo = $_FILES['file']['type'];
    $tamano_archivo = $_FILES['file']['size'];
    $filec = $_FILES['file']['tmp_name'];
    $path_archivo = $repositor . "/" . $nombre_archivo;
    //Config del archivo
    $maxSize = 1; //MB
    $limit = $maxSize * 1024 * 1024;
    $validExt = ($type == 'images') ? ['jpg', 'jpeg', 'png', 'gif'] : ['pdf'];
    $fileExtension = explode('.', $nombre_archivo);
    $fileExtension = strtolower(end($fileExtension));
    $typeF = ($type == 'images') ? 'la imagen' : 'el archivo';

    //compruebo si las características del archivo son las que deseo 
    if (!in_array($fileExtension, $validExt) || ($tamano_archivo > $limit)) {
        $class = 'alert-danger';
        $status = 'Error';
        $msg = $typeF . ' NO ha sido aceptada.';
    } else {
        //Compruebo donde se va guardar en el servidor o en DB
        /*if ($saveDB == 1 || $saveDB == 2) {
            $fileContenido = addslashes(file_get_contents($filec)); //*Solo permite procesar un 1MB.
            //Insertar imagen en la base de datos
            $insertar = "INSERT INTO upload_files (nombre, type_file, filec, created_at) VALUES ('$nombre_archivo', '$tipo_archivo', '$fileContenido', now())";
            $insertar = $conec->prepare($insertar);
            $insertar->execute();
            // Condicional para verificar la subida del fichero
            if ($insertar) {
                $class = 'alert-success';
                $status = 'Correcto';
                $msg = $typeF . ' se guardo correctamente.';
                //Extraer imagen de la BD mediante GET
                $sql = $conec->prepare("SELECT * FROM upload_files WHERE nombre=:nombre");
                $sql->bindValue(':nombre', $nombre_archivo);
                $sql->execute();
                $numRows = $sql->rowCount();
                if ($numRows > 0) {
                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                    $imgUrl = 'data:' . $tipo_archivo . ';base64,' . base64_encode($row['filec']);
                    //$imgUrl = strval($page_url.'api/upload/blob.php?id='.$row['ID']);
                }
            } else {
                $class = 'alert-danger';
                $status = 'Error';
                $msg = 'Ocurrio algun error al guardar ' . $typeF . '. Intentelo nuevamente.';
            }
        }*/

        if ($saveDB == '' || $saveDB == 0 || $saveDB == 2) {
            if (@move_uploaded_file($filec, $path_archivo)) {
                $class = 'alert-success';
                $status = 'Correcto';
                $msg = $typeF . ' se subio correctamente.';
                $imgUrl = $page_url . 'api/upload/' . $path_archivo;
            } else {
                $class = 'alert-danger';
                $status = 'Error';
                $msg = 'Ocurrio algun error al subir ' . $typeF . '. Intentelo nuevamente.';
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
}

//ERROR
function Error($error){
//global $tabla;
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
    //if ($tabla == 'upload_files') {
        $resultado['name'] = '';
        $resultado['url'] = '';
    //}
    $res['metadata'] = $meta;
    $res['data'] = $resultado;
    echo json_encode($res); //echo json_encode($resultado);
}

function message($msg){
    $status = 'Correcto';
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json');
    $meta = array("status" => "success", "http_code" => 200, "date_time" => date('c'), "message" => "ok");
    $resultado['status'] = $status;
    $resultado['mensaje'] = $msg;
    //$resultado['html'] = $msg_box;
    //$resultado['name'] = '';
    //$resultado['url'] = '';
    $res['metadata'] = $meta;
    $res['data'] = $resultado;
    echo json_encode($res); //echo json_encode($resultado);
}

//message('mensaje','GET','Error','code');

//MENSAJES
$msj_test = 'Mensaje de prueba';
$msj_ok = 'ok';
$msj_login = 'Usted esta en el Login';
$msj_profile = 'Usted esta en el Profile';
$msj_upload = 'Usted esta en el upload';
//ERROR
$Error_id = 'No existe ID!';
$Error_msj = 'La consulta no se ejecuto';