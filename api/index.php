<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Pruebas</title>
    <link rel="stylesheet" href="../assets/estilo.css" type="text/css">
</head>
<body>

<div  class="container">
    <h1>Api de pruebas</h1>
    <div class="divbody">
        <h3>Auth - login</h3>
        <code>
           POST  /login
           <br>
           {
               <br>
               "usuario" :"", -> REQUERIDO
               <br>
               "password": "" -> REQUERIDO
               <br>
            }
        
        </code>
    </div>      
    <div class="divbody">   
        <h3>Pacientes - Utilizar versión /v1 ó /v2</h3>
        <code>
           GET  /pacientes
           <br>
           GET  /pacientes/$idPaciente
        </code>

        <code>
           POST  /pacientes
           <br> 
           {
            <br> 
               "nombre" : "",               -> REQUERIDO
               <br> 
               "dni" : "",                  -> REQUERIDO
               <br> 
               "correo":"",                 -> REQUERIDO
               <br> 
               "codigoPostal" :"",             
               <br>  
               "genero" : "",        
               <br>        
               "telefono" : "",       
               <br>       
               "fechaNacimiento" : "",      
               <br>         
               "token" : ""                 -> REQUERIDO        
               <br>       
           }

        </code>
        <code>
           PUT  /pacientes/$idPaciente
           <br> 
           {
            <br> 
               "nombre" : "",               
               <br> 
               "dni" : "",                  
               <br> 
               "correo":"",                 
               <br> 
               "codigoPostal" :"",             
               <br>  
               "genero" : "",        
               <br>        
               "telefono" : "",       
               <br>       
               "fechaNacimiento" : "",      
               <br>         
               "token" : "" , -> REQUERIDO        
               <br>       
               "pacienteId" : "" -> REQUERIDO
               <br>
           }

        </code>
        <code>
           DELETE  /pacientes/$idPaciente
           <br> 
           {   
               <br>    
               "token" : "", -> REQUERIDO        
               <br>       
               "pacienteId" : "" -> REQUERIDO
               <br>
           }

        </code>
    </div>


</div>
    
</body>
</html>



<?php
/*
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
*/
?>