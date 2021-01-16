$(document).ready(function(){
	$('#mostrar').on('click', function(){
		$.getJSON("http://localhost/MisSitios/phponix/bloques/ws/t/opciones/")
		.done(function(datos_del_ws){
			var datos="";
			$.each(datos_del_ws, function(indice, valor){
				if(valor.ID!=''){
				//$("#resultadoOpciones ul").append('<li>'+valor.nom+'('+valor.valor+')</li>');
				datos+='<li>'+valor.nom+'('+valor.valor+')</li>';
				}
				});
			$("#resultadoOpciones ul").html(datos);
		});
	});		
});