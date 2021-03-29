var $ = jQuery.noConflict();
$(document).ready(function () {    
    cargar();
    
    function cargar(){
        $("#loader").fadeIn('slow');
        var idb = document.getElementById('id_b').value;
        console.log(idb);
        var params = { "IDB": idb }
        $.ajax({
            type: "POST",
            url: '../../modulos/blog/admin/backend.php?action=comentarios',
            data: params,
            beforeSend: function (objeto) {
                $("#loader").html("<img src='apps/dashboards/loader.gif'>");
            },success: function(response){
                $('#form_coment_div').html(response);
            }
        });
    }

    //Guardar Comentario
    $(document).on('click', '#btn-ingresar', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../../modulos/blog/admin/backend.php?mod=blog&action=addcoment',
            type: 'POST',
            data: $("#form_coment").serialize(),
            success: function (response) {
              console.log("Comentario enviado");              
              $("#aviso").html(response);
              $(".alert-dismissible").delay(4000).fadeOut("slow");
              $("#form_coment").trigger("reset");
              cargar();
            }
        });
    });

});