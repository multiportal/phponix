<?php 
function html_iso_directorio(&$titulo,&$des,&$tag,&$autor){
global $chartset;
 if($chartset=='iso-8859-1'){
	$titulo=htmlentities($titulo, ENT_COMPAT,'ISO-8859-1', true);
	$des = htmlentities($des, ENT_COMPAT,'ISO-8859-1', true);
	$tag = htmlentities($tag, ENT_COMPAT,'ISO-8859-1', true);	
	$autor=htmlentities($autor, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function js_select_text($sel,$col,$table,&$ctrl_sel){
global $mysqli,$DBprefix;
$nom_ctrl=$col;$id_ele='div_combo';
$sql=mysqli_query($mysqli,"SELECT DISTINCT ".$col." FROM ".$DBprefix.$table.";") or print mysqli_error($mysqli);
$selector='<select class="form-control" id="'.$nom_ctrl.'" name="'.$nom_ctrl.'">';
	while($row=mysqli_fetch_array($sql)){
		$seleccion=($row[$col]==$sel) ? 'selected' : '';
		$selector.='<option value="'.$row[$col].'" '.$seleccion.'>'.$row[$col].'</option>';
	}
$selector.='</select>';	
$ctrl_sel='<div id="'.$id_ele.'">'.$selector.'<div><a href="javascript:add_select_text(1);"><i class="fa fa-plus"></i> Agregar Categoria</a></div></div>';

echo '
<script>
function add_select_text(val){
	if(val==1){	
		document.getElementById(\''.$id_ele.'\').innerHTML=\'<input type="text" class="form-control" id="'.$nom_ctrl.'" name="'.$nom_ctrl.'" value=""><div><a href="javascript:add_select_text(0);">Cancelar</a></div>\';
	}
	else{
		document.getElementById(\''.$id_ele.'\').innerHTML=\''.$selector.'<div><a href="javascript:add_select_text(1);"><i class="fa fa-plus"></i> Agregar Categoria</a></div>\';
	}
}
</script>
';
}
?>