<?php include 'admin/functions.php';
$row = query_row($tabla,'ID',$id);
if($row){
  $cover=$row['cover'];
  $titulo=$row['titulo'];
  $descripcion=$row['descripcion'];
  $contenido=$row['contenido'];
  $tag=$row['tag'];
  $autor=$row['autor'];
  $fecha=$row['fecha'];
}
//one_blog();
if($tema=='porto'){
  include 'porto.php';
}else if($tema=='portophponix'){
  include 'portophponix.php';
}
else{
  include 'default.php';
}
?>

<script type='text/javascript' src='<?php echo $page_url;?>modulos/blog/js/ajax_coment.js'></script>