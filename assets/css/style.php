<?php 
$archivo=fopen('assets/css/style.css','w');

css_web($css_web);

if($tema=='default'){
$css_default='
@import url(https://fonts.googleapis.com/css?family=Open+Sans);
@import url(https://fonts.googleapis.com/css?family=Oswald:300,400,700);
@import url('.$page_url.'assets/bootstrap/bootstrap.css);
@import url('.$page_url.'assets/css/font-awesome-4.7.0/css/font-awesome.css);
@import url('.$page_url.$path_tema.'css/style.css);
body{
margin:0;
}
*{font-family:Arial;}
a, a:link{text-decoration:none;}
.row{margin:0;}
.clear{width:100%;height:30px;}
#head{width:100%;height:80px;color:#fff;background:#37474f;}
#content{width:100%;}
#modulo{width:100%;min-height:400px;margin:0 auto; padding: 0px 0px 0px 0px;}
#footer{width:100%;color:#fff;background:#333;}
#logo-min{float:left;width:150px;margin:0 15px;}
#menu-web{float:right;width:900px;margin:15px 35px;text-align:right;}
#cont-normal{text-align:center; padding-top:35px;}
#cont-user{text-align:center; padding-top:35px;}
#cont-div{text-align:center; padding-top:35px;}
#alert-system{margin:80px auto 20px auto; width:1200px; padding:10px 5px; height:200px; text-align:center;}
/*FICHA_TEMA------------------------------------------------------------------------------------------------------*/
#ficha_tema{margin:25px auto;}
#cover{float:left;width:50%;text-align:center;}
#detalles{float:left;width:50%;}
@media screen and (max-width:1200px){
#menu-web{width:400px; margin:15px 15px;}
}
@media screen and (max-width:600px){
#menu-web{width:150px; margin:15px 2px;}
}
';
}else{$css_default='';}

$contenido='/*style - '.$date.'*/'.$css_default.$css_web;

fwrite($archivo, $contenido);
fclose($archivo);
if($archivo == false){
 	echo '<!--No se ha podido crear el archivo.-->';
}else{
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$page_url.'assets/css/style.css?'.$date.'" />'."\r\n";
}

?>