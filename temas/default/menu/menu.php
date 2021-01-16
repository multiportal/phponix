<?php
function cadena_replace_m(&$replace1,&$replace2){
	$replace1=array(' ','.',',','(',')','/','"','á','é','í','ó','ú','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','Á','É','Í','Ó','Ú','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','ñ','Ñ','&ntilde;','&Ntilde;','&','amp;');
	$replace2=array('-','-','-','-','-','-','-','a','e','i','o','u','a','e','i','o','u','A','E','I','O','U','A','E','I','O','U','n','N','n','N','','');
}

function title(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$path_tema,$tema_previo,$title;	
echo ucfirst($mod).' | '.$title;
}

function login(&$login_se,$username,$ID_login){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$path_tema,$tema_previo,$dboard;
 if(isset($_SESSION['username'])){
	$login_se='<a href="'.$page_url.'index.php?mod='.$dboard.'"><i class="fa fa-sign-in"></i> '.$username.'</a> <a href="'.logout($ID_login).'" title="Salir"><i class="fa fa-power-off"></i></a>';
 }else{
	$login_se='<a href="'.$page_url.'admin/"><i class="fa fa-sign-in"></i> Login</a>';
 }
}

function top_bg(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$idp;
	$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_web WHERE modulo='{$mod}' AND ext='{$ext}' AND ima_top!='';") or print mysqli_error($mysqli); 
    if($reg=mysqli_fetch_array($sql)){$ima_top=$reg['ima_top'];}else{$ima_top='gris.png';}
    echo'<style>
    .banner_mod {
         background: url('.$page_url.'modulos/Home/media/top/'.$ima_top.')no-repeat 0px 0px;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        -ms-background-size: cover;
        background-size: cover;
        background-position: center;
     	min-height: 380px;
		border-bottom: 5px solid #c8102e;
     }
     </style>';	
}

function tit_seccion(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$idp;
$cond=($ext!='' && $ext!='index')?" AND ext='{$ext}'":"";//echo $cond;
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_web WHERE modulo='{$mod}'".$cond.";") or print mysqli_error($mysqli); 
 if($reg=mysqli_fetch_array($sql)){
    $menu=$reg['menu'];$tit_sec=$reg['tit_sec'];
	if($tit_sec!=''){echo $tit_sec;}else{echo $menu;}
 }	
}

function des_seccion(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$idp;
$cond=($ext!='' && $ext!='index')?" AND ext='{$ext}'":"";
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."menu_web WHERE modulo='{$mod}'".$cond.";") or print mysqli_error($mysqli); 
 if($reg=mysqli_fetch_array($sql)){
	 $des_tit=$reg['des_sec'];
	 echo $des_tit;
 }	
}

function nom_cate(&$cate){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc,$idp;	
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."productos_cate WHERE ID_cate='{$idp}';") or print mysqli_error($mysqli); 
 if($reg=mysqli_fetch_array($sql)){
 	$cate=$reg['categoria'];
 }
}

function link_url(&$link_url,$url_m,$mod_menu,$ext_menu){
global $mysqli,$DBprefix,$url,$URL,$page_url,$mod,$ext,$opc,$path_tema,$tema_previo;
sql_opciones('link_var',$valor);
 if($valor==1){
	if($mod_menu!=''){$mod_menu='?mod='.$mod_menu;}
	if($ext_menu!=''){$ext_menu='&ext='.$ext_menu;}
	$link_url='index.php'.$mod_menu.$ext_menu;
 }else{
 	if($tema_previo!='' && $tema_previo!=NULL){
		$url_m2=(substr($url_m,0,1)=='#')?$url_m:'';
		if($mod_menu!=''){$mod_menu='&mod='.$mod_menu;}
		if($ext_menu!=''){$ext_menu='&ext='.$ext_menu;}
		$link_url=$page_url.'index.php?tema_previo='.$tema_previo.$mod_menu.$ext_menu.$url_m2;	
 	}else{
		$link_url=(substr($url_m,0,1)=='#')?$URL.$url_m:$page_url.$url_m;
 	}
 }
}

function menu_web(){
global $mysqli,$DBprefix,$url,$page_url,$mod,$ext,$opc,$path_tema,$tema_previo;
$menu_json='menu.json';
$path_JSON=$path_tema.'menu/'.$menu_json;
if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/?t=menu_web';}
if($path_JSON){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);
usort($Data, function($a, $b){return strnatcmp($a['ord'], $b['ord']);});//Orden del menu
$i=0;
if($_SESSION['level']!=-1){echo '<!-- menu.json -->'."\n\r";}else{echo '<!-- menu.json URL:('.$path_JSON.')-->'."\n\r";}

	foreach ($Data as $rowm){$i++;
		$ID_menu=$rowm['ID'];
		$nom_menu=$rowm['menu'];
		$url_m=$rowm['url'];
		$mod_menu=$rowm['modulo'];
		$ext_menu=$rowm['ext'];
		$orden=$rowm['ord'];
		$sub_menu=$rowm['subm'];
		$visible=$rowm['visible'];
		
		if($visible==1 && $sub_menu==NULL){
			$link_css1=($mod==$rowm['modulo'])?' active':'';
			$k=0;$link_css2='';
			foreach ($Data as $row){
				$ID_menu1=$row['ID'];
				$nom_menu1=$row['menu'];
				//$url_m1=$row['url'];
				$sub_menu1=$row['subm'];
				$visible1=$row['visible'];
				if($visible1!=0 && $sub_menu1!='' && $sub_menu1==$ID_menu){$k++;
					$link_css2=' menu-item-has-children has-sub';
					if($_SESSION['level']!=-1){echo '<!-- k:'.$k.' -->'."\n\r";}else{echo '<!--1 k:'.$k.' ID:'.$sub_menu1.' ID_menu:'.$ID_menu1.' CSS:'.$link_css2.' -->'."\n\r";}
				}				
			}			
			link_url($link_url,$url_m,$mod_menu,$ext_menu);
			echo ' / <!--'.$i.'-'.$mod_menu.'--><a href="'.$link_url.'" title="'.$link_url.'">'.$nom_menu.'</a>';
			$n=0;$j=0;
			foreach ($Data as $rowm){if($rowm['visible']==1 && $rowm['subm']==$ID_menu){$n++;}}
			echo '<!--'.$n.'-->';
			foreach ($Data as $rowm){
				$nom_menu2=$rowm['menu'];
				$url_m2=$rowm['url'];
				$mod_menu2=$rowm['modulo'];
				$ext_menu2=$rowm['ext'];
				$sub_menu2=$rowm['subm'];
				$visible2=$rowm['visible'];
				if($visible2==1 && $sub_menu2==$ID_menu){$j++;
					if($j==1){echo "\n\r".'<ul class="sub-menu">'."\n\r";}
					link_url($link_url2,$url_m2,$mod_menu2,$ext_menu2);
					echo '<li><!--j:'.$j.'--><a href="'.$link_url2.'">'.$nom_menu2.'</a></li>'."\n\r";
					if($n==$j){echo '</ul>'."\n\r";}
				}
			}
			echo '</li>';
		}
	}
 echo '<!-- /menu.json -->
 ';
 }
}

function menu_responsivo(){
global $mysqli,$DBprefix,$url,$page_url,$mod,$ext,$opc,$path_tema,$tema_previo;
$menu_json='menu.json';
$path_JSON=$path_tema.'menu/'.$menu_json;
if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/?t=menu_web';}
if($path_JSON){
$objData=file_get_contents($path_JSON);
$Data=json_decode($objData,true);
usort($Data, function($a, $b){return strnatcmp($a['ord'], $b['ord']);});//Orden del menu
$i=0;
 if($_SESSION['level']!=-1){echo '<!-- menu.json -->'."\n\r";}else{echo '<!-- menu.json URL:('.$path_JSON.')-->'."\n\r";}
	foreach ($Data as $rowm){$i++;
		$ID_menu=$rowm['ID'];
		$nom_menu=$rowm['menu'];
		$url_m=$rowm['url'];
		$mod_menu=$rowm['modulo'];
		$ext_menu=$rowm['ext'];
		$orden=$rowm['ord'];
		$sub_menu=$rowm['subm'];
		$visible=$rowm['visible'];
		
		if($visible==1 && $sub_menu==NULL){
			$link_css1=($mod==$rowm['modulo'])?'active ':'';
			$k=0;$link_css2='';$link_css3='';$link_css4='';$a_datos='';
			foreach ($Data as $row){
				$ID_menu1=$row['ID'];
				$nom_menu1=$row['menu'];
				//$url_m1=$row['url'];
				$sub_menu1=$row['subm'];
				$visible1=$row['visible'];
				if($visible1!=0 && $sub_menu1!='' && $sub_menu1==$ID_menu){$k++;
					$link_css2='dropdown';
					$link_css3='class="dropdown-toggle" data-toggle="dropdown"';
					$link_css4=' <b class="caret"></b>';
					$a_datos='';
					if($_SESSION['level']!=-1){echo '<!-- k:'.$k.' -->'."\n\r";}else{echo '<!--1 k:'.$k.' ID:'.$sub_menu1.' ID_menu:'.$ID_menu1.' CSS:'.$link_css2.' -->'."\n\r";}
				}				
			}			
			link_url($link_url,$url_m,$mod_menu,$ext_menu);
			echo '<!--'.$i.'-'.$mod_menu.'--><li class="'.$link_css1.$link_css2.'"><a '.$link_css3.' href="'.$link_url.'"'.$a_datos.'>'.$nom_menu.$link_css4.'</a>';
			$n=0;$j=0;
			foreach ($Data as $rowm){if($rowm['visible']==1 && $rowm['subm']==$ID_menu){$n++;}}
			echo '<!--'.$n.'-->';
			foreach ($Data as $rowm){
				$nom_menu2=$rowm['menu'];
				$url_m2=$rowm['url'];
				$mod_menu2=$rowm['modulo'];
				$ext_menu2=$rowm['ext'];
				$sub_menu2=$rowm['subm'];
				$visible2=$rowm['visible'];
				if($visible2==1 && $sub_menu2==$ID_menu){$j++;
					if($j==1){echo "\n\r".'<ul class="dropdown-menu submenus">'."\n\r";}
					link_url($link_url2,$url_m2,$mod_menu2,$ext_menu2);
					echo '<!--j:'.$j.'--><li><a href="'.$link_url2.'">'.$nom_menu2.'</a></li>'."\n\r";
					if($n==$j){echo '</ul>'."\n\r";}
				}
			}
			echo '</li>'."\n\r";
		}
		
	}
 echo '<!-- /menu.json -->
 ';
 }
}

function slider(){
global $mysqli,$DBprefix,$tema,$page_url,$path_tema,$mod,$ext,$opc;
$nomt='slider';
$fjson=$nomt.'_'.$tema.'.json';
$path_JSON='modulos/Home/'.$fjson;
if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/'.$nomt.'/';}
 if($path_JSON){
 $objData=file_get_contents($path_JSON);
 $Data=json_decode($objData,true);
 $i=-1;
	$op_f=($_SESSION['level']!=-1)?'<!-- '.$fjson.' -->'."\n\r":'<!-- '.$fjson.' URL:('.$path_JSON.')-->'."\n\r";
	foreach ($Data as $rowm){$i++;
		$id=$rowm['ID'];
		$cover=$rowm['ima'];
		$tit1=$rowm['tit1'];
		$tit2=$rowm['tit2'];
		$btn=$rowm['btn_nom'];
		$url_s=$rowm['url'];
		$tema_slider=$rowm['tema_slider'];
		$act=($i!=0)?'':' active';
		$visible=$rowm['visible'];
		if($visible==1 && $tema_slider==$tema){
			$indicador.='
			<li data-target="#myCarousel" data-slide-to="'.$i.'" class="'.$act.'"></li>';

			$tit1_1=($tit1!='')?'<h3>'.$tit1.'</h3>':'';
			$tit2_1=($tit2!='')?'<p>'.$tit2.'</p>':'';
			$btn_1=($btn!='')?'<div class="a-btn"><a class="btn-cer" href="'.$url_s.'">'.$btn.'</a></div>':'';

			$diapositivas.='
			<div class="item item'.$id.$act.'" style="background:-webkit-linear-gradient(rgba(23, 22, 23, 0.2), rgba(23, 22, 23, 0.5)), url(./modulos/Home/media/slide/'.$cover.') no-repeat;
			background:-moz-linear-gradient(rgba(23, 22, 23, 0.2), rgba(23, 22, 23, 0.5)), url(./modulos/Home/media/slide/'.$cover.') no-repeat;
			background:-ms-linear-gradient(rgba(23, 22, 23, 0.2), rgba(23, 22, 23, 0.5)), url(./modulos/Home/media/slide/'.$cover.') no-repeat; 
			background:linear-gradient(rgba(23, 22, 23, 0.2), rgba(23, 22, 23, 0.5)), url(./modulos/Home/media/slide/'.$cover.') no-repeat;
			background-size:cover;"> 
				<div class="container">
					<div class="carousel-caption">
					'.$tit1_1.$tit2_1.$btn_1.'
					</div>
				</div>
			</div>
			';
		}//if
	}//foreach
		echo '
		<!-- banner -->
		'.$op_f.'
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
        		'.$indicador.'
			</ol>
			<div class="carousel-inner" role="listbox">
        		'.$diapositivas.'
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
			<!-- The Modal -->
    	</div> 
		<!-- //banner -->
		';	
 }
}

function testimonios(){
global $mysqli,$DBprefix,$page_url,$mod,$ext,$opc;
//sql_opciones('link_productos',$valor);
$fjson='testimonios';
$path_JSON='modulos/'.$mod.'/'.$fjson.'.json';
 if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/?t='.$fjson.'&ajax=1';}
 echo $rut_origen=($_SESSION['level']!=-1)?'<!-- '.$fjson.' -->'."\n\r":'<!-- '.$fjson.' URL:('.$path_JSON.')-->'."\n\r";

 if($path_JSON){
	$objData=file_get_contents($path_JSON);
	$Data=json_decode($objData,true);
	$i=0;
	
	if($Data!='' && $Data!=NULL){
		echo '<!-- '.$fjson.'.json -->';
		foreach ($Data as $reg){$i++;
			$ID=$reg['ID'];
			$cover=$reg['cover'];
			$pro=$reg['pro'];
			$comentario=$reg['comentario'];
			$visible=$reg['visible'];
			$act=($i==1)?'active':'';		
			if($visible==1){
	$circulos.='<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'" class="'.$act.'"></li>';				
	$slide.='<!--['.$i.'] -'.$ID.'-->
    <div class="carousel-item '.$act.'">	
      <img class="d-block w-1001" src="'.$page_url.'modulos/Home/media/'.$fjson.'/'.$cover.'" style="margin:0 auto;" alt="First slide">
      <p style="font-size:11px;">&quot;'.$comentario.'&quot;</p>
	</div>';
			}
		}
		echo '<!-- /'.$fjson.'.json -->';
	}
	echo '
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  	'.$circulos.'
  </ol>
  <div class="carousel-inner2">
  	'.$slide.'
  </div>
</div>';	
 }else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>No hay definiciones disponibles.</div>
		</div>
	';
 }
}

function css_web(&$css_web){
global $mysqli,$DBprefix,$url,$page_url,$mod,$ext,$opc,$tema,$path_tema,$tema_previo;
	$css2='css2';
	$path_JSON='bloques/webservices/rest/json/'.$css2.'.json';
	if(!file_exists($path_JSON)){$path_JSON=$page_url.'bloques/ws/t/?t='.$css2;}
	if($path_JSON){
	$objData=file_get_contents($path_JSON);
	$Data=json_decode($objData,true);
	usort($Data, function($a, $b){return strnatcmp($a['ID'], $b['ID']);});//Orden del menu
	$i=0;
	//if($_SESSION['level']!=-1){echo '<!-- .json -->'."\n\r";}else{echo '<!-- .json URL:('.$path_JSON.')-->'."\n\r";}	
		foreach ($Data as $rowm){$i++;
			$ID_css=$rowm['ID'];
			$tema_css=$rowm['nom'];
			$contenido_css=$rowm['contenido'];
			$visible=$rowm['visible'];			
			if($visible==1){
				$css_web=$contenido_css;
			}
		}
	}
}

?>