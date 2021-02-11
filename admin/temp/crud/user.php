<?php
require_once '../../conexion/conexion_PDO.php';
require_once 'crud.php';
//$conexion = new Conexion();
//$conexion->conectar();
$crud = new Crud("man_signup");
/*$crud->insert([
			"username" => "user",
			"nombre" => "y",
			"apaterno" => "x"
]);*/
$lista = $crud->get();
$num_array = count($lista);
echo '<div>Numero de registros:'.$num_array.'</div>';
$campos='';$td='';
for($i=0;$i<$num_array;$i++){
  $row=$lista[$i];
  $td.='<tr id="">'."\n";
  foreach($row as $datos => $value){
    if($i==1){//echo '<div>'.$datos.':'.$value.'</div>';
      $campos.='<th>'.$datos.'</th>'."\n";
    }
    $td.='<td>'.$value.'</td>'."\n";
  }
  $td.='<td><button class="btn btn-secondary btn-edit"><i class="fa fa-edit"></i></button> | <button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button></td>';
  $td.='</tr>'."\n";

}
$campos.='<th>Acciones</th>'."\n";
$th='<tr>'.$campos.'</tr>'."\n";
  

  /*
  $row=$lista[$i];
  echo '<tr id="">'."\n";   
  foreach($row as $datos=>$value){
    echo '<td>'.$row[$datos].'</td>'."\n";
  }
  echo '<td><button class="btn btn-secondary btn-edit"><i class="fa fa-edit"></i></button> | <button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button></td>';
  echo '</tr>'."\n";
  */
    //$usuario.='<div>'.$row->username.'</div>';


//echo '<pre>';
//echo $usuario;
//echo '</pre>';
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Tabla: Usuarios</h2>
  <p><a href="#">Agregar Usuario</a></p>            
  <table class="table table-striped">
    <thead>
      <tr>
        <?php echo $th;?>
      </tr>
    </thead>
    <tbody>
        <?php echo $td;?>
    </tbody>
  </table>
</div>

</body>
</html>