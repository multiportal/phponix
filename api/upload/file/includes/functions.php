<?php

function fileUpload(){
    $host = $_SERVER['HTTP_HOST']; //Nombre del dominio (dominio.com).
    $dominio = ($host == 'localhost') ? 'http://' . $host . '/' : 'https://' . $host . '/';
    $path_root = 'MisSitios/apirestm/';
    $page_url = $dominio . $path_root;

    $type = (isset($_GET['type'])) ? $_GET['type'] : '';
    //$cover = 'api/upload/file/images/nodisponible1.jpg';
    $msg_box = '';

    //datos del arhivo 
    $repositor = ($type == 'images') ? 'images' : 'docs';
    $nombre_archivo = $_FILES['file-upload']['name'];
    $tipo_archivo = $_FILES['file-upload']['type'];
    $tamano_archivo = $_FILES['file-upload']['size'];
    $path_archivo = $repositor . "/" . $nombre_archivo;
    $limite_file = 1; //MB

    if ($type == 'images') {
        //compruebo si las características del archivo son las que deseo 
        if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < ($limite_file * 1024 * 1000)))) {
            $class = 'alert-danger';
            $status = 'Error';
            $msg = 'La imagen NO ha sido aceptada.';
        } else {
            if (@move_uploaded_file($_FILES['file-upload']['tmp_name'], $path_archivo)) {
                $class = 'alert-success';
                $status = 'Correcto';
                $msg = 'La imagen se subio correctamente.';
            } else {
                $class = 'alert-danger';
                $status = 'Error';
                $msg = 'Ocurrio algun error al subir la Imagen. Intentelo nuevamente.';
            }
        }
    } else {
        //compruebo si las características del archivo son las que deseo 
        if (!((strpos($tipo_archivo, $type)) && ($tamano_archivo < ($limite_file * 1024 * 1000)))) {
            $class = 'alert-danger';
            $status = 'Error';
            $msg = 'El archivo NO ha sido aceptado.';
        } else {
            if (@move_uploaded_file($_FILES['file-upload']['tmp_name'], $path_archivo)) {
                $class = 'alert-success';
                $status = 'Correcto';
                $msg = 'El archivo se subio correctamente.';
            } else {
                $class = 'alert-danger';
                $status = 'Error';
                $msg = 'Ocurrio algun error al subir el fichero. Intentelo nuevamente.';
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
    $resultado['url'] = $page_url . 'api/upload/file/images/' . $nombre_archivo;
    $res['metadata'] = $meta;
    $res['data'] = $resultado;
    echo json_encode($res);
}

//ERROR
function Error($error){
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
    $resultado['name'] = '';
    $resultado['url'] = '';
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

//message('mensaje','GET','Error');

//MENSAJES
$msj_test = 'Mensaje de prueba';
$msj_ok = 'ok';
$msj_login = 'Usted esta en el Login';
$msj_profile = 'Usted esta en el Profile';
$msj_upload = 'Usted esta en el upload';
//ERROR
$Error_id = 'No existe ID!';
$Error_msj = 'La consulta no se ejecuto';
