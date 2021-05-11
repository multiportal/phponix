//Javascript app_style_var.js
const url_css='http://localhost/MisSitios/phponixdev/api/v1/?tabla=css2';
const registros = () => {
	fetch(url_css).then(res=>res.json()).then(data=>{//console.log(data);
		let tr = '';
		data.forEach(datos => {//console.log(datos);
			const {ID,nom,contenido,visible} = datos;
			if(visible==1){
				var sharp=contenido.substr(0,1);
				var box = (sharp=='#')?`<div class="input-group my-colorpicker2 colorpicker-element">
				<input type="text" class="form-control" id="val[${ID}]" name="val[${ID}]" value="${contenido}" autocomplete="off">
				<div class="input-group-addon">
				  <i></i>
				</div>
			  </div>`:`<input type="text" class="form-control" id="val[${ID}]" name="val[${ID}]" value="${contenido}" autocomplete="off">`;
				tr += `
				<div class="form-group">
					<input type="hidden" class="form-control" id="ID[${ID}]" name="ID[${ID}]" value="${ID}" autocomplete="off">	  
					<label for="${nom}">
					  	${ID}. ${nom} 
						<input type="hidden" class="form-control" id="nom[${ID}]" name="nom[${ID}]" value="${nom}" autocomplete="off">
						<span id="${ID}"><i class="fa fa-trash btn-delete"></i></span>
					</label>
				  	${box}
				</div>`;
			}
		});console.log('Datos Cargados');
		document.getElementById('reg-form').innerHTML=tr;//$('#reg-form').html(tr);
    })
    .catch(err=>console.log(err));
}
registros();//setInterval(registros,10000);

//BOTON GUARDAR
$(document).on('click', '.btn-guardar', function (e) {
	e.preventDefault();
	$.ajax({
		url: './modulos/Home/admin/backend.php?opc=add-var',
		type: 'POST',
		data: $("#add-form").serialize(),
		success: function (response) {
			console.log('Estilo Agregado');
			$("#aviso").html(response);
			$("#aviso").fadeOut(8000);
			$('#add-form').trigger('reset');
			registros();
		}
	});
});

//EDITAR
$('#edit-form').submit(function(e){
	e.preventDefault();
	$.ajax({
		url: './modulos/Home/admin/backend.php?opc=edit-var',
		method: 'POST',
		data: $(this).serializeArray(),		
		success: function(response){
			console.log('Registros Actualizados');
			$("#aviso2").fadeIn();
			$("#aviso2").html(response).fadeOut(8000);
			registros();
		}
	})
});

//BOTON BORRAR
$(document).on('click', '.btn-delete', function () {
    const element = $(this)[0].parentElement;
    const id = $(element).attr('id');
    Swal.fire({
      title: '¿Esta seguro de eliminar el registro (' + id + ')?',
      text: "¡Esta operación no se puede revertir!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Borrar'
    }).then((result) => {
      if (result.value) {
        $.post('./modulos/Home/admin/backend.php?opc=delete-var', {ID:id}, (response) => {
          console.log(response);
          registros();
        });
        Swal.fire('¡Eliminado!', 'El registro ha sido eliminado.', 'success')
      }
    })
});

