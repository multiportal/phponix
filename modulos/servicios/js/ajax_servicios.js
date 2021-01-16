
// JavaScript Document
	function load(page){
		var parametros = {"mode":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'modulos/servicios/admin/backend.php?mod=servicios',
			data: parametros,
			beforeSend: function(objeto){
				$("#loader").html("<img src='apps/dashboards/loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data);
				$("#loader").html("");
			}
		});
	}

$(document).ready(function(){
	// Global Settings
	//console.log('jQuery esta funcionando');
	let edit = false;
	load(1);	
 	//listar();
	//$("#task-result").hide();

	/*$(document).on("click","#listado",function(){
		listado(1);
	});*/

	function listado(page){
		var parametros = {"mode":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'modulos/servicios/admin/backend.php?mod=servicios&action=listado',
			data: parametros,
			beforeSend: function(objeto){
				$("#loader").html("<img src='modulos/servicios/img/loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data);
				$("#loader").html("");
			}
		});
	}

	//LISTAR
	/*
	function listar(){
		$.ajax({
			url: 'modulos/servicios/admin/backend.php?action=list',
			type: 'POST',
			//dataType : 'json',
			success: function(response){
				let tasks=JSON.parse(response);
				let template="";
				
				tasks.forEach(task=>{
        		template += `
                  <tr taskId="${task.ID}">
                  <td>${task.ID}</td>
                  <td>
                  <a href="#" class="task-item">${task.nom}</a>
                  </td>
                  <td>${task.descripcion}</td>
                  <td>
                    <button class="task-delete btn btn-danger">Borrar</button>
                  </td>
                  </tr>
                `
					});
				$("#task").html(template);
			}
		});
	}
	setInterval(listar,30000);*/

	//AGREGAR/EDITAR
	$("#form1").submit(function(e){
		e.preventDefault();
		tinyMCE.triggerSave();
		const postData={
			
			cover: $("#cover").val(),
			clave: $("#clave").val(),
			titulo: $("#titulo").val(),
			des: $("#des").val(),
			precio: $("#precio").val(),
			cate: $("#cate").val(),
			visible: $("#visible").val(),
      		id: $("#id").val()
		};
		const url = edit === false ? 'modulos/servicios/admin/backend.php?mod=servicios&ext=admin/index&action=add' : 'modulos/servicios/admin/backend.php?mod=servicios&ext=admin/index&action=edit';		
		console.log(postData, url);
		$.post(url,postData,function(response){
			console.log("Se ha actualizado el registro.");			
			$("#aviso").html(response).fadeIn("slow");
			$("#aviso").fadeOut(6000);
			//$("form1").trigger('reset');	
			//listar();
			//edit = false;
		});
	});

	//editar_form
	/*
	$(document).on('click','.task-item',function(){	
		const element = $(this)[0].parentElement.parentElement;
      	const id = $(element).attr('taskId');
      	$.post('modulos/servicios/admin/backend.php?action=edit_form', {id}, (response) => {
			console.log(response);
			const task=JSON.parse(response);
      		$("#nom").val(task.nom);
      		$("#des").val(task.descripcion);
      		$("#taskId").val(task.ID);
      		edit = true;
        });		
	});*/

	//BORRAR
	$(document).on('click','.task-delete',function(){
	  const element = $(this)[0];
      const id = $(element).attr('taskId');
      if(confirm("Esta seguro de eliminar este Servicio"+id+"?")) {
      	$.post('modulos/servicios/admin/backend.php?action=delete', {id}, (response) => {
			console.log(response);
          	load(1);
        });
	  }
	});

	//SUBIR COVER
	$(document).on('click','#Aceptar',function(e){		
		e.preventDefault();
		var frmData=new FormData;
		frmData.append("userfile",$("input[name=userfile]")[0].files[0]);
		//console.log('Se cargo Imagen');		
		$.ajax({
			url: 'modulos/servicios/admin/backend.php?mod=servicios&action=subir_cover',
			type: 'POST',
			data: frmData,
			processData:false,
			contentType:false,
			cache:false,
			beforeSend: function(data){
				$("#imagen").html("Subiendo Imagen");
			},
			success: function(data){
				//$("#form1").trigger("reset");
				$("#imagen").html(data);
				console.log("Subido Correctamente");
			}
		});
		//return false;
	});

	//BUSCAR
	$("#q").keyup(function(e){
	  if($("#q").val()){
		let q=$("#q").val();
		$.ajax({
			url: 'modulos/servicios/admin/backend.php?action=buscar',
			type: 'POST',
			data: {q},
			success: function(response){
				let tasks=JSON.parse(response);
				console.log(response);
				let template='<div class="box-body">';
				let sel="";
				tasks.forEach(task=>{
				visible=`${task.visible}`;
				sel=(visible==0)?'<span style="color:#e00;"><i class="fa fa-close" title="Desactivado"></i></span>':'<span style="color:#0f0;"><i class="fa fa-check" title="Activo"></i></span>';	
        		template += `
	<div class="col-md-3 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border">
       			<h3 class="box-title">C&oacute;digo: <b>${task.clave}</b></h3>
				<span class="controles">${sel}
					<a href="http://localhost/MisSitios/phponix/index.php?mod=servicios&ext=admin/index&form=1&action=edit&id=${task.ID}" title="Editar"><i class="fa fa-edit"></i></a> | <a href="#" taskid="${task.ID}" class="task-delete" title="Borrar"><i class="fa fa-trash"></i></a>
				</span>
			</div>
			<div class="box-body">
				<div class="ima-size">
					<img src="http://localhost/MisSitios/phponix/modulos/servicios/fotos/${task.cover}" class="ima-size img-responsive">
				</div>
				<div id="title"><strong>${task.titulo}</strong></div>	
			</div><!-- /.box-body -->
		</div>
	</div>`
				});
				$(".outer_div").html(template+"</div>");
			}
		});
	  }	 
	});
	
});
