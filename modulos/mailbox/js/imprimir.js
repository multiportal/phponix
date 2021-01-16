function imprimirElemento(elemento) {
  var ventana = window.open('', 'PRINT', 'height=600,width=900');
  ventana.document.write('<html><head><title>' + document.title + '</title>');
  ventana.document.write(' <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"><!-- Bootstrap 3.3.6 --><link rel="stylesheet" href="http://localhost/MisSitios/phponix/apps/dashboards/AdminLTE/bootstrap/css/bootstrap.min.css"><!-- Font Awesome --><!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"--><link rel="stylesheet" href="http://localhost/MisSitios/phponix/assets/css/font-awesome-4.7.0/css/font-awesome.css"><!-- Ionicons --><!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"--><link rel="stylesheet" href="http://localhost/MisSitios/phponix/apps/dashboards/AdminLTE/dist/css/ionicons.min.css"><!-- DataTables --><link rel="stylesheet" href="http://localhost/MisSitios/phponix/apps/dashboards/AdminLTE/plugins/datatables/dataTables.bootstrap.css"><!-- Theme style --><link rel="stylesheet" href="http://localhost/MisSitios/phponix/apps/dashboards/AdminLTE/dist/css/AdminLTE.min.css"><!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. --><link rel="stylesheet" href="http://localhost/MisSitios/phponix/apps/dashboards/AdminLTE/dist/css/skins/_all-skins.min.css"><!--select--><link rel="stylesheet" href="http://localhost/MisSitios/phponix/assets/bootstrap-select/dist/css/bootstrap-select.css"><!-- iCheck --><link rel="stylesheet" href="http://localhost/MisSitios/phponix/apps/dashboards/AdminLTE/plugins/iCheck/flat/blue.css"><!-- bootstrap wysihtml5 - text editor --><link rel="stylesheet" href="http://localhost/MisSitios/phponix/apps/dashboards/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">'); //Cargamos otra hoja, no la normal
  ventana.document.write('</head><body >');
  ventana.document.write(elemento.innerHTML);
  ventana.document.write('</body></html>');
  ventana.document.close();
  ventana.focus();
  ventana.onload = function() {
    ventana.print();
    ventana.close();
  };
  return true;
}

document.querySelector("#btnImprimir").addEventListener("click", function() {
  var div = document.querySelector("#imprimir_email");
  imprimirElemento(div);
});

document.querySelector("#btnImprimir2").addEventListener("click", function() {
  var div = document.querySelector("#imprimir_email");
  imprimirElemento(div);
});