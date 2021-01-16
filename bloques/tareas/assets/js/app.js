// JavaScript Document
$(document).ready(function(){
	// Global Settings
	let edit = false;
 	//console.log('jQuery esta funcionando');
	listar();
	$('#task-result').hide();

	//BUSCAR	
	$('#search').keyup(function(e){
	  if($('#search').val()){
		let search=$('#search').val();
		$.ajax({
			url: 'admin/backend.php?opc=buscar',
			type: 'POST',
			data: {search},
			success: function(response){
				let tasks=JSON.parse(response);
				let template='';
				
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
				$('#task').html(template);
				//$('#task-result').show();
			}
		});
	  }	 
	});

	//AGREGAR/EDITAR
	$('#task-form').submit(function(e){
		e.preventDefault();
		const postData={
			nom: $('#nom').val(),
			des: $('#des').val(),
      		id: $('#taskId').val()
		};
		const url = edit === false ? 'admin/backend.php?opc=add' : 'admin/backend.php?opc=edit';		
		console.log(postData, url);
		$.post(url,postData,function(response){
			console.log(response);
			$('#task-form').trigger('reset');	
			listar();
			edit = false;
		});
	});	

	//editar_form
	$(document).on('click','.task-item',function(){	
		const element = $(this)[0].parentElement.parentElement;
      	const id = $(element).attr('taskId');
      	$.post('admin/backend.php?opc=edit_form', {id}, (response) => {
			console.log(response);
			const task=JSON.parse(response);
      		$('#nom').val(task.nom);
      		$('#des').val(task.descripcion);
      		$('#taskId').val(task.ID);
      		edit = true;
        });		
	});

	//BORRAR
	$(document).on('click','.task-delete',function(){
      if(confirm('Esta seguro de eliminar esta tarea?')) {
		const element = $(this)[0].parentElement.parentElement;
      	const id = $(element).attr('taskId');
      	$.post('admin/backend.php?opc=delete', {id}, (response) => {
			console.log(response);
          	listar();
        });
	  }
	});	

	//LISTAR
	function listar(){
		$.ajax({
			//url: 'http://localhost/MisSitios/phponix/bloques/ws/t/index.php?t=tareas',
			url: 'admin/backend.php?opc=list',
			type: 'POST',
			//dataType : 'json',
			success: function(response){
				let tasks=JSON.parse(response);
				let template='';
				
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
				$('#task').html(template);
			}
		});
	}
	setInterval(listar,30000);
	
});
