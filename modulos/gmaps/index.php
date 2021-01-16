<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["activo"]==1){
	//if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
	include 'admin/functions.php';
	include 'assets/plugins/sidebar/index.php';
?>
  <link href="<?php echo $page_url;?>modulos/gmaps/css/gmaps.css" rel='stylesheet' type='text/css' />
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBiB2Ny_sdk1kyc8tVK64NfxQ1b0yQoaWw" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo $page_url;?>modulos/gmaps/js/gmaps.js"></script>

<div id="map"></div>

<?php crear_gmaps_config();?>

<?php
	}else{header("Location: ".$page_url."admin/");}
	//}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>