<?php 
include 'lib.php';
$t_rama='m_temas';
//$datos=array('{"ID":"1","tema":"default","subtema":"","selec":"1","nivel":"0"}','{"ID":"2","tema":"man","subtema":"","selec":"0","nivel":"0"}','{"ID":"3","tema":"phponix","subtema":"","selec":"0","nivel":"0"}');
//for($i=0;$i<count($datos);$i++){query_insertar($datos[$i],$t_rama);}
/*
$id_key="-MCcmFPmwEwSAyDq0JJa";
$datos='{"ID":"2","tema":"mandragora","subtema":"","selec":"0","nivel":"0"}';
query_editar($datos,$t_rama,$id_key);
*/
//$id_key="-MCcmFPmwEwSAyDq0JJa";
//query_borrar($t_rama,$id_key);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/0f5e4d39f5.js" crossorigin="anonymous"></script>
<div class="content">
  <div class="row">
    <div class="col-lg-8">
<hr>
<table class="table table-striped">
  <?php query_tabla($t_rama);?>
</table>
<hr>    
    </div>
    <div class="col-lg-4"></div>
  </div>
</div>

<?php
//query_all($t_rama);//Mostrar todos los datos personalizado

/*
query_id($t_rama,'ID',3,$key,$row);//Buscar y Mostrar un registro por ID
echo '<div>Index:'.$key.'</div>';
echo '<div>ID:'.$row['ID'].'</div>';
echo '<div>Menu:'.$row['menu'].'</div>';
*/
/*
$c_res='tema';
$c_bus='selec';
$resultado=query_opc($t_rama,$c_res,$c_bus,1);
echo $resultado;
*/
/*
$c_bus='visible';
query_buscar($t_rama,$c_bus,1);
*/

/*
$a = array(
    "uno" => 1,
    "dos" => 2,
    "tres" => 3,
    "diecisiete" => 17
);
foreach ($a as $k => $v) {
    echo '<div>'.$k.'='.$v.'</div>';
    //echo "\$a[$k] => $v.\n";
}
*/
/*
$url='https://mandragorajs.firebaseio.com/'.$t_rama.'.json';
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_HTTPGET,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$response=curl_exec($ch);
curl_close($ch);
//print_r($response);
$data=json_decode($response,true);
foreach($data as $key => $value){$nc=$data[$key];} echo '<div>Numero de campos: '.$num_c=count($nc).'</div>';

foreach($data as $key => $value){
  echo '<div>Index: '.$key.' - ID:'.$data[$key]['ID'].'</div>';
  $data2=$data[$key];
  foreach($data2 as $datos=>$value){
    echo '<div>'.$datos.':'.$data[$key][$datos].'</div>';
  }
}
echo '<div>Obtener Datos Simple de los campos</div>';
foreach($data as $key){
  echo '<div>ID: '.$key['ID'].'</div>';
  $data2=$key;
  foreach($data2 as $datos=>$value){
    echo '<div>'.$datos.':'.$key[$datos].'</div>';
  }
}
*/
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



