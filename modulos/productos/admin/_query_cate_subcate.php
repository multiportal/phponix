<?php
include '../../../admin/conexion.php';
//$html='<option value="">Seleccionar</option>';
$html='';
$IDcate=$_POST["elegido"];
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_sub_cate WHERE ID_cate='{$IDcate}';") or print mysqli_error($mysqli);
while($row=mysqli_fetch_array($sql)){$ID_sub_cate=$row['ID_sub_cate'];$clave=$row['ord'];$subcategoria=$row['subcategoria'];
	$html.='<option value="'.$ID_sub_cate.'">'.$clave.' '.$subcategoria.'</option>';
}
echo $html;	
?>