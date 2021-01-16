<?php
error_reporting(E_ALL & ~E_NOTICE);
include("geoiploc.php"); 
  if (empty($_POST['checkip'])){
	$ip = $_SERVER["REMOTE_ADDR"]; 
  }
  else{
	$ip = $_POST['checkip']; 
  }
$resultado='Tu direcci&oacute;n IP es: '.$ip.'<br>
Tu Pa&iacute;s es: '.getCountryFromIP($ip, " NamE").'-'.getCountryFromIP($ip, "code");
echo $resultado;
?> 