// JavaScript Document


$(document).ready(function(){
	registros();
	
	function registros(){
		$.ajax({
			type: 'POST',
			url: 'modulos/sys/admin/backend.php?opc=registros',
			success: function(response) {			
				$('#reg_opciones').html(response);
	   		}
		});
	}
	//setInterval(registros, 5000);

	//Agregar Opcion
	$('#add-form').submit(function(e){
		e.preventDefault();
		const postData={
			nom: $('#nom').val(),
			descripcion: $('#descripcion').val(),
			valor: $('#valor').val(),			
      		id: $('#ID').val()
		};
		const url = 'modulos/sys/admin/backend.php?opc=add';		
		console.log(postData, url);
		$.post(url,postData,function(response){
			console.log(response);
			$('#add-form').trigger('reset');
			registros();	
		});
	});
	
	//Editar estado de opcion	
	$('#edit-form').on('click','#reg_opciones input[type=checkbox]',function(e){
		var idReg=$(this).attr('data-idRegistro');
		idVal=0;
		if($(this).is(':checked')){
			idVal=1;
		}  
		console.log('ID:'+idReg+'='+idVal);
		const postData={
			valor: idVal,			
      		ID: idReg
		};		
		const url = 'modulos/sys/admin/backend.php?opc=edit';		
		console.log(postData, url);
		$.post(url,postData,function(response){
			console.log(response);
			registros();
		});
	});

	//BORRAR
/*	$(document).on('click','.reg-delete',function(){
      if(confirm('Esta seguro de eliminar esta opcion?')) {
		const element = $(this)[0].parentElement;
      	const id = $(element).attr('data-idRegistro');
      	$.post('admin/backend.php?opc=borrar', {id}, (response) => {
			console.log(response);
          	registros();
        });
	  }
	});	*/

});
