<?php 
function html_iso(&$nombre,&$adres,&$des,&$info){
global $chartset;
 if($chartset=='iso-8859-1'){
	$nombre=htmlentities($nombre, ENT_COMPAT,'ISO-8859-1', true);
	$adres=htmlentities($adres, ENT_COMPAT,'ISO-8859-1', true);	
	$des=htmlentities($des, ENT_COMPAT,'ISO-8859-1', true);
	$info=htmlentities($info, ENT_COMPAT,'ISO-8859-1', true);
 }
}

function crear_gmaps_config(){
global $mysqli,$DBprefix,$page_url;

$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."map_config WHERE ID=1;") or print mysqli_error($mysqli); 
if($row=mysqli_fetch_array($sql)){
	$lat=$row['lat'];
	$lng=$row['lng'];
	$zoom=$row['zoom'];
	$icono=$row['cover'];
	$on_costo=$row['on_costo'];
}
$precio=($on_costo==1)?"Costo: $'+item.precio+'pesos<br>":"";
$index='$index';
$contenido="
var map;

    function loadResults (data) {
      var items, markers_data = [];
      if (data.length > 0) {
        items = data;

        for (var i = 0; i < items.length; i++) {
          var item = items[i];

          if (item.lat != undefined && item.lng != undefined) {
            var icon = '".$page_url."modulos/gmaps/images/markes/".$icono."';

            markers_data.push({
              lat : item.lat,
              lng : item.lng,
              title : item.nom,
        	  infoWindow: {
          		content: '<p style=\"width:250px;\"><b>'+item.nom+'</b><br>Tel: '+item.tel+'<br>".$precio."Direccion: '+item.adres+'<br>Info: '+item.info+'</p>'
        	  },
              icon : {
                size : new google.maps.Size(59, 50),
                url : icon
              }
            });
          }
        }
      }

      map.addMarkers(markers_data);
    }
	/*
    function printResults(data) {
      $('#foursquare-results').text(JSON.stringify(data));
      prettyPrint();
    }
	*/
    $(document).on('click', '.pan-to-marker', function(e) {
      e.preventDefault();

      var position, lat, lng, $index;

      $index = $(this).data('marker-index');

      position = map.markers[$index].getPosition();

      lat = position.lat();
      lng = position.lng();

      map.setCenter(lat, lng);
    });

    $(document).ready(function(){
      //prettyPrint();
      map = new GMaps({
        div: '#map',
        lat: ".$lat.",
        lng: ".$lng.",
		zoom: 12
      });

      map.on('marker_added', function (marker) {
        var index = map.markers.indexOf(marker);
        //$('#results').append('<li><a href=\"#\" class=\"pan-to-marker\" data-marker-index=\"' + index + '\">' + marker.title + '</a></li>');
		/*
        if (index == map.markers.length - 1) {
          map.fitZoom();
        }*/
      });

      var xhr = $.getJSON('".$page_url."modulos/gmaps/js/data-ubicacion.json');

      //xhr.done(printResults);
      xhr.done(loadResults);
    });
";
$aviso=($contenido!='')? '<div>Se han capturados los datos.</div>': '<div style="color:#f00;">Error: No se han capturados los datos.</div>';
crear_archivo('modulos/gmaps/js/','data-config.js',$contenido,$path_file);
if(file_exists($path_file)){$aviso.='<div>Se ha creado el archivo ('.$nombre_archivo.') correctamente.</div>';}else{$aviso.='<div>No se ha creado el archivo ('.$nombre.') correctamente.</div>';}
echo $aviso;
echo '<script type="text/javascript" src="'.$page_url.$path_file.'"></script>';
}
?>