<?php 
function obtener_semana($semana,&$sem,&$option,&$tot_v){
global $mysqli,$DBprefix,$fecha;
 if($semana){
	$sem=$_POST['sem'];
 }else{
	$fecha = new DateTime($fecha);
	$semana = $fecha->format('W');
	$sem=$semana;
 }

 for($i=1; $i<=52; $i++){
	$sel=($i==$sem)?'selected':'';
	$option.='<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
 }
 
 $week2=$sem-1;$tot_v=0;$k=-3;
 for($i=0; $i<7; $i++){$k++;
 	$day_f=date('Y-m-d', strtotime('01/00-1 +' . $week2 . ' weeks first day +' . $k . ' day'));
	$sql=mysqli_query($mysqli,"SELECT DISTINCT ip FROM `".$DBprefix."visitas` WHERE fecha LIKE '%".$day_f."%';") or print mysqli_error($mysqli);
	$num_v=mysqli_num_rows($sql);
	$tot_v+=$num_v;
 }
}

function select_year(){
global $mysqli,$DBprefix,$year;
	$years=$_POST['years'];
	//$sql=mysqli_query($mysqli,"SELECT DISTINCT fecha FROM ".$DBprefix."visitas WHERE fecha LIKE '%12-31 0%' GROUP BY fecha ORDER BY fecha DESC") or print mysqli_error($mysqli);
	$sql=mysqli_query($mysqli,"SELECT fecha FROM ".$DBprefix."visitas ORDER BY ID ASC") or print mysqli_error($mysqli);
	if($row=mysqli_fetch_array($sql)){$year_ini=substr($row['fecha'], 0, 4);}
	$ny=$year-$year_ini;$year_fin=$year;
	//echo '<option>'.$year.'-'.$year_ini.'='.$ny.'</option>';
	for($i=0;$i<=$ny;$i++){
		$sel=($year_fin==$years)?'selected':'';
		echo '<option value="'.$year_fin.'" '.$sel.'>'.$year_fin.'</option>';
		$year_fin--;
	}		
}

function visitas_ref($vhref){
global $mysqli,$DBprefix,$year,$month,$day;	
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."visitas WHERE refer LIKE '%{$vhref}%' AND fecha>='{$year}-{$month}-01 00:00:00' AND fecha<='{$year}-{$month}-31 23:59:59';") or print mysqli_error($mysqli);
	$num_vf=mysqli_num_rows($sql);
	echo $num_vf;
}
?>