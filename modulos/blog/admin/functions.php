<?php 
function html_iso(&$titulo,&$des,&$tag,&$autor){
global $chartset;
 if($chartset=='iso-8859-1'){
	$titulo=htmlentities($titulo, ENT_COMPAT,'ISO-8859-1', true);
	$des = htmlentities($des, ENT_COMPAT,'ISO-8859-1', true);
	$tag = htmlentities($tag, ENT_COMPAT,'ISO-8859-1', true);	
	$autor=htmlentities($autor, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function item_blog(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;

$topic='topic';

$menu_json='blog.json';
$path_JSON='modulos/blog/'.$menu_json;

if(file_exists($path_JSON)){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);
if($Data!='' && $Data!=NULL){
$i=0;
echo '<!-- blog.json -->';
	foreach ($Data as $reg){$i++;
		$visible=$reg['visible'];
		if($visible==1){
		echo '<!--['.$i.'] -'.$reg['ID'].'-->

	<div class="col-lg-4 col-xs-12 h-item">
      	<div class="titb"><h3><strong>'.$reg['titulo'].'</strong></h3></div>
		<p class="new-font"><!--span class="glyphicon glyphicon-calendar" aria-hidden="true"></span--> <a href="'.$page_url.'blog/'.$topic.'/'.$reg['ID'].'-item" class="fontB">'.$reg['fecha'].'</a> por <a href="" class="fontB">'.$reg['autor'].'</a></p>
       	<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$reg['cover'].'" alt="'.$reg['tag'].'" class="img-resp">
		<!--div class="div-clear"><p>&nbsp;</p></div-->
        <div class="new-font2">'.$reg['descripcion'].'</div>
    	<!--div class="div-clear"><p>&nbsp;</p></div-->
        <div class="text-right"><a href="'.$page_url.'blog/'.$topic.'/'.$reg['ID'].'-item" class="btn_azul">Ver Más</a></div>
        <!--div class="div-clear"><p>&nbsp;</p></div-->
    </div>

			';
		}else{
				echo '<div class="col-lg-12 col-xs-12">
					<div>Por el momento no hay entradas disponibles para este blog.</div>
				</div>
  				';

		}
	}
	echo '<!-- /blog.json -->';
 }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay entradas para este blog.</div>
		</div>
  ';
 }
}else{
echo '<!-- mysql -->';
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."blog WHERE visible=1 ORDER BY ID DESC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
		echo'<!-- '.$reg['ID'].'-->
	<div class="col-lg-4 col-xs-12">
      	<div class="titb"><h3><strong>'.$reg['titulo'].'</strong></h3></div>
		<p class="new-font"><!--span class="glyphicon glyphicon-calendar" aria-hidden="true"></span--> <a href="'.$page_url.'blog/'.$topic.'/'.$reg['ID'].'-item" class="fontB">'.$reg['fecha'].'</a> por <a href="" class="fontB">'.$reg['autor'].'</a></p>
       	<img src="'.$page_url.'modulos/'.$mod.'/fotos/'.$reg['cover'].'" alt="'.$reg['tag'].'" class="img-resp">
		<!--div class="div-clear"><p>&nbsp;</p></div-->
        <div class="new-font2">'.$reg['descripcion'].'</div>
    	<!--div class="div-clear"><p>&nbsp;</p></div-->
        <div class="text-right"><a href="'.$page_url.'blog/'.$topic.'/'.$reg['ID'].'-item" class="btn_azul">Ver Más</a></div>
        <!--div class="div-clear"><p>&nbsp;</p></div-->
    </div>
		';
	}
	echo '<!--/ mysql -->';
  }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay entradas para este blog.</div>
		</div>
  ';
  }
 }
}

function sidebar_blog(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
$topic='topic';
$menu_json='blog.json';
$path_JSON='modulos/blog/'.$menu_json;

if(file_exists($path_JSON)){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);
if($Data!=''){
$i=0;
echo '<!-- blog.json -->';
	foreach ($Data as $reg){$i++;
		$visible=$reg['visible'];
		if($visible==1){
			echo '
								<li>
									<a href="'.$page_url.'blog/'.$topic.'/'.$reg['ID'].'-item">'.$reg['titulo'].'</a>
									<span class="post-date">'.$reg['fecha'].'</span>
								</li>
			';
		}
	}
	echo '<!-- /blog.json -->';
 }
}else{
echo '<!-- mysql -->';
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."blog WHERE visible=1 ORDER BY ID DESC;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	while($reg=mysqli_fetch_array($sql)){
			echo '
								<li>
									<a href="'.$page_url.'blog/'.$topic.'/'.$reg['ID'].'-item">'.$reg['titulo'].'</a>
									<span class="post-date">'.$reg['fecha'].'</span>
								</li>
			';

	}
	echo '<!--/ mysql -->';
  }
 }
}
?>