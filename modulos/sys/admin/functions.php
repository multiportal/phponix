<?php 
function html_iso(&$page_name1,&$title1,&$keywords1,&$description1){
global $chartset;
 if($chartset=='iso-8859-1'){
	$page_name1 = htmlentities($page_name1, ENT_COMPAT,'ISO-8859-1', true);
	$title1 = htmlentities($title1, ENT_COMPAT,'ISO-8859-1', true);
	$keywords1 = htmlentities($keywords1, ENT_COMPAT,'ISO-8859-1', true);	
	$description1 = htmlentities($description1, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function analytics(&$google_analytics1){
 $google_analytics1=str_replace("'","\'",$google_analytics1);
}

function page_mode($mode){
global $mysqli,$DBprefix;
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."mode_page;") or print mysqli_error($mysqli); 
 while($row=mysqli_fetch_array($sql)){
	$id=$row['ID'];
	$page_mode=$row['page_mode'];
	$seleccion=($page_mode==$mode)?'selected':'';
	echo '<option value="'.$page_mode.'" '.$seleccion.'>'.$page_mode.'</option>';
 }
}

function options(&$checks,&$num_rows){
global $mysqli,$DBprefix;
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."opciones;") or print mysqli_error($mysqli); 
$num_rows=mysqli_num_rows($sql);
 while($row=mysqli_fetch_array($sql)){
	$ID=$row['ID'];
	$val=$row['valor'];
	$checked=($val==1)?'checked':'';
	$nom=$row['nom'];
	if($ID!=12){
 	$checks.='
              <!-- checkbox -->
              <div class="form-group">
                <label Id="'.$ID.'">
				  <span>'.$ID.'. </span>
				  <div class="icheckbox_minimal-blue '.$checked.'" aria-checked="true" aria-disabled="false" style="position: relative;">
				  	<input type="checkbox" data-idRegistro="'.$ID.'" id="opc'.$ID.'" name="opc'.$ID.'" class="minimal" style="position: absolute; opacity: 0;"'.$checked.'>
				  </div>                  
                  <span>'.$nom.'</span>
                </label>
              </div>
 	';
	}
 }	
}

function js_select_text($sel,$nom_ctrl,$id_ele,$col,$table,&$js_sel,&$ctrl_sel){
global $mysqli,$DBprefix;	
$sql=mysqli_query($mysqli,"SELECT DISTINCT ".$col." FROM ".$DBprefix.$table.";") or print mysqli_error($mysqli);
$selector='<select class="form-control" id="'.$nom_ctrl.'" name="'.$nom_ctrl.'">';
	while($row=mysqli_fetch_array($sql)){
		$seleccion=($row[$col]==$sel) ? 'selected' : '';
		$selector.='<option value="'.$row[$col].'" '.$seleccion.'>'.$row[$col].'</option>';
	}
$selector='</select>';	

$js_sel= '
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

$ctrl_sel='<div id="'.$id_ele.'">'.$selector.'<div><a href="javascript:add_select_text(1);"><i class="fa fa-plus"></i> Agregar Categoria</a></div></div>';
}
?>