<?php 
include 'apps/dashboards/functions.php';
open_page_LTE();
?>
<!-- Site wrapper -->
<div class="wrapper">
<!-- Contenido del sesion_header.php -->
<?php include ($path_dashboard.'sesion_header.php'); ?>
  <!-- =============================================== -->

  <!-- Contenido del sesion_sidebar.php -->
<?php include ($path_dashboard.'sesion_sidebar.php'); ?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	<?php echo bodymodulos();?>

  </div>
  <!-- /.content-wrapper -->

  <!-- Contenido del sesion_footer.php -->
<?php include ($path_dashboard.'sesion_footer.php'); ?>
  <!-- =============================================== -->
