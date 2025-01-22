// JavaScript Document
let dbAjaxCrud = localStorage.getItem("dbCrud_servicios"); //Obtener datos de localStorage
dbAjaxCrud = JSON.parse(dbAjaxCrud); // Covertir a objeto
var listado = 0;
//LISTADO

function inicio(){
    if (dbAjaxCrud !== null) {
		//console.log(dbAjaxCrud);
		listado = dbAjaxCrud[0].val;
		console.log("listado:"+listado);
    } else {
		console.log("Vacio");
		const valor = {
			val: listado
		}
		listar=[];
		listar.push(valor);
		localStorage.setItem("dbCrud_servicios", JSON.stringify(listar));
		console.log(listado);		
	}
	dbAjaxCrud = localStorage.getItem("dbCrud_servicios");
	dbAjaxCrud = JSON.parse(dbAjaxCrud);
}

function load(page,q) {
  inicio();
  let action = (listado == 1) ? '&action=listado' : '';
  var parametros = {
    "mode": "ajax",
	"page": page,
	"q": q
  };
  if (listado == 1) {
    $(".btn-listado").removeClass('activar-listado');
    $(".btn-large").removeClass('btn-blue');
    $(".btn-listado").addClass('btn-blue');
    $(".btn-large").addClass('activar-large');
  } else {
    $(".btn-listado").removeClass('btn-blue');
    $(".btn-large").removeClass('activar-large');
    $(".btn-listado").addClass('activar-listado');
    $(".btn-large").addClass('btn-blue');
  }

  $("#loader").fadeIn('slow');
  $.ajax({
    url: 'modulos/servicios/admin/backend.php?mod=servicios' + action,
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='apps/dashboards/loader.gif'>");
    },
    success: function (data) {
      $(".outer_div").html(data);
      $("#loader").html("");
    }
  });
}

$(document).ready(function () {
  // Global Settings   
  console.log('jQuery:ajaxCrud esta funcionando');
  let edit = false;
  load(1);

  //BOTONES VISTAS
  $(document).on('click', '.activar-listado', function () {	
	dbAjaxCrud[0] = {
		val: 1
	}
	localStorage.setItem("dbCrud_servicios", JSON.stringify(dbAjaxCrud));
	listado = dbAjaxCrud[0].val;//listado = 1;
	//console.log("listado1:"+listado);
    load(1);
  });
  $(document).on('click', '.activar-large', function () {	  
	dbAjaxCrud[0] = {
		val: 0
	}
	localStorage.setItem("dbCrud_servicios", JSON.stringify(dbAjaxCrud));
	listado = dbAjaxCrud[0].val;//listado = 0;
	//console.log("listado0:"+listado);
	load(1);
  });

  //AGREGAR/EDITAR
  $("#form1").submit(function (e) {
    e.preventDefault();
    tinyMCE.triggerSave();
    const postData = {
clave: $("#clave").val(),
nombre: $("#nombre").val(),
cover: $("#cover").val(),
FT: $("#FT").val(),
cate: $("#cate").val(),
resena: $("#resena").val(),
descripcion: $("#descripcion").val(),
precio: $("#precio").val(),
url_page: $("#url_page").val(),
alta: $("#alta").val(),
fmod: $("#fmod").val(),
user: $("#user").val(),
imagen1: $("#imagen1").val(),
imagen2: $("#imagen2").val(),
imagen3: $("#imagen3").val(),
imagen4: $("#imagen4").val(),
imagen5: $("#imagen5").val(),
      visible: $("#visible").val(),
      ID: $("#id").val()
    };
    //const url = edit === false ? 'modulos/servicios/admin/backend.php?mod=servicios&ext=admin/index&action=add' : 'modulos/servicios/admin/backend.php?mod=servicios&ext=admin/index&action=edit';
    let edo = ($("#id").val() != '') ? 'edit' : 'add';
    const url = 'modulos/servicios/admin/backend.php?mod=servicios&ext=admin/index&action=' + edo;
    console.log(postData, url);
    $.post(url, postData, function (response) {
      //console.log(response);
      console.log("Se ha " + edo + " el registro.");
      $("#aviso").html(response).fadeIn("slow");
      $("#aviso").fadeOut(6000);
      //$("form1").trigger('reset');//listar();//edit = false;
    });
  });

  //BOTON EDITAR
  $(document).on('click', '.btn-edit', function () {
    const element = $(this)[0].parentElement;
	const id = $(element).attr('id');
	window.location.href="index.php?mod=servicios&ext=admin/index&form=1&action=edit&id="+id;
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
        $.post('modulos/servicios/admin/backend.php?action=delete', {
          id
        }, (response) => {
          console.log(response);
          load(1);
        });
        Swal.fire('¡Eliminado!', 'El registro ha sido eliminado.', 'success')
      }
    })
  });

  //SUBIR COVER
  $(document).on('click', '#Aceptar', function (e) {
    e.preventDefault();
    var frmData = new FormData;
    frmData.append("userfile", $("input[name=userfile]")[0].files[0]);
    //console.log(frmData);
    $.ajax({
      url: 'modulos/servicios/admin/backend.php?mod=servicios&action=subir_cover',
      type: 'POST',
      data: frmData,
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function (data) {
        $("#imagen").html("Subiendo Imagen");
      },
      success: function (data) {
        //console.log(data);
        $("#imagen").html(data);
        $(".alert-dismissible").delay(4000).fadeOut("slow");
        console.log("Subido Correctamente");
      }
    });
    //return false;
  });

  //BUSCAR
  $("#q").keyup(function (e) {
    var buscar = $("#q").val();
    if (buscar!="") {
      load(1,buscar);
    }else{
      load(1);
    }
  });

});

function imagenes(val) {
  console.log('Imagen: ' + val);
  let file = 'userfile' + val;
  var frmData = new FormData;
  frmData.append("userfile", $("input[name=userfile" + val + "]")[0].files[0]);
  //console.log(frmData);
  $.ajax({
    url: 'modulos/servicios/admin/backend.php?mod=servicios&action=subir_cover&val=' + val,
    type: 'POST',
    data: frmData,
    processData: false,
    contentType: false,
    cache: false,
    beforeSend: function (data) {
      $("#ima" + val).html("Subiendo Imagen");
    },
    success: function (data) {
      //console.log(data);
      $("#ima" + val).html(data);
      $(".alert-dismissible").delay(4000).fadeOut("slow");
      console.log("Subido Correctamente");
    }
  });
}

function refrescar(){
	sessionStorage.removeItem("dbCrud_servicios");
	dbAjaxCrud[0] = {
		val: listado
	}
	localStorage.setItem("dbCrud_servicios", JSON.stringify(dbAjaxCrud));
	listado = dbAjaxCrud[0].val;//listado = 0;
	//console.log("listado0:"+listado);
	load(1);
}
