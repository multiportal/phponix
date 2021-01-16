<?php
include '../../../admin/conexion.php';
$enviar=$_POST['enviar'];
$nombre=$_POST['nombre']; 
$mensaje=$_POST['mensaje'];
push_simple($enviar,$nombre,$mensaje);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Notificaciones</title>
</head>
<body>
<form method="post" action="<?php echo $URL;?>">
nombre: <input type="text" id="nombre" name="nombre"><br>
mensaje: <input type="text" id="mensaje" name="mensaje"><br>
<input type="submit" value="Enviar"><br>
<input type="hidden" id="enviar" name="enviar" value="ok">
</form>
<script src="../js/jquery-1.11.1.min.js"></script> <!-- incluye jquery para usar ajax -->
<script src="../js/push.min.js"></script> <!-- incluye la libreria push -->
<script> 
function ver(){  
 $.ajax({ //se inicia la petición ajax al archivo que consulta los mensajes en la base de datos
    type : 'GET', //consulta mediante get
    url : 'consulta_msg.php', //url del archivo a consultar
    data : {'ID_user':'1'}, //consulta el id del propietario
    dataType : 'json', //se espera retornar un json
    success : function(data) { //si fue satisfactorio la petición ajax retorna la variable data con la información
    	$.each(data, function(i, item) { //recorremos el json para obtener los mensajes
        	var texto = item.texto;
        	var emisor = item.emisor;
        	var num_msg = item.num_msg;
                        
            if(num_msg>0){
            	Push.create(emisor, { //llamamos al objeto push escrito en jquery
                	body: texto, //ingresamos el texto recuperado de la petición ajax
                    timeout: 30000, //con este valor indica que despues de 4000 ms se cierre automaticamente el mensaje
                    onClick: function () { //al hacer click en la notificación se cerrará
						window.focus();
						this.close();
					}
				});
			}
        
		});
	},
 }); 
}
setInterval(ver,3000); //cada 10000 ms se ejecuta la función ver para obtener los mensajes recibidos
//recordar que cada 1000 ms es lo mismo que 1 segundo
 </script>
</body>
</html>