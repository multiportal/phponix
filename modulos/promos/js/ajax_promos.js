//Javascript
function load(page,q) {
  //inicio();
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
    url: 'modulos/promos/admin/backend.php?mod=promos' + action,
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='apps/dashboards/loader.gif'>");
    },
    success: function (data) {//console.log(data);
      $(".outer_div").html(data);
      $("#loader").html("");
    }
  });
}

$(document).ready(function () {
  // Global Settings   
  console.log('jQuery:ajaxCrud esta funcionando');
  listado=0;
  load(1);

  //BORRAR
  $(document).on('click', '.btnBorrar', function () {
    const element = $(this)[0];
    const id = $(element).attr('portaid');
    Swal.fire({
      title: '¿Esta seguro de eliminar el proyecto (' + id + ')?',
      text: "¡Esta operación no se puede revertir!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Borrar'
    }).then((result) => {
      if (result.value) {
        $.post('modulos/promos/admin/backend.php?action=delete', {
          id
        }, (response) => {
          console.log(response);
          load(1);
        });
        Swal.fire('¡Eliminado!', 'El proyecto ha sido eliminado.', 'success')
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
      url: 'modulos/promos/admin/backend.php?mod=promos&action=subir_cover',
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

});