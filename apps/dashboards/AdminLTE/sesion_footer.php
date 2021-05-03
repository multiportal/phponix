<?php 
if(isset($_SESSION["username"])){
?>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> <?php echo $ver_web;?>
    </div>
    <strong>Copyright &copy; 2017-<?php echo $year;?> <a target="_blank" href="<?php echo $page_url;?>index.php"><?php echo $page_name;?></a>. </strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!--UPLOAD_COVER->
<script src="<?php echo $page_url;?>assets/plugins/upload_ima/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="<?php echo $page_url;?>assets/plugins/upload_ima/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<!--/UPLOAD_COVER-->

<!-- jQuery 2.2.3 -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $page_url.$path_dashboard;?>bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $page_url.$path_dashboard;?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!--Select-->
<script src="<?php echo $page_url;?>assets/bootstrap-select/dist/js/bootstrap-select.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/chartjs/Chart.min.js"></script>
<!-- InputMask -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo $page_url.$path_dashboard;?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo $page_url.$path_dashboard;?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="<?php echo $page_url.$path_dashboard;?>dist/js/moment.min.js"></script>
<script src="<?php echo $page_url.$path_dashboard;?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $page_url.$path_dashboard;?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $page_url.$path_dashboard;?>dist/js/demo.js"></script>

<?php if($mod=='mailbox'){?>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $page_url.$path_dashboard;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
<?php }?>
<!-- page script -->
<?php if($mod=='estadisticas'){
include	'./modulos/estadisticas/chartjs.php';
}?>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<script>
  $(function () {
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.14.4/dist/sweetalert2.all.min.js"></script>
<?php 
sql_opciones('VUE2',$valor);
if($valor==1){
  $path_file='./assets/js/VUEjs/vue2.2.0.js';
  if(file_exists($path_file)){
	echo '<script src="'.$page_url.'assets/js/VUEjs/vue2.2.0.js"></script>';
  }
}
?>
<?php
if($mod=='directorio'){
	echo '<!--script src="'.$page_url.'assets/js/VUEjs/vue-resource.min.1.5.1.js"></script-->';
	echo '<script src="'.$page_url.'assets/js/VUEjs/axios.min.0.16.1.js"></script>';
}
$path_file='./modulos/'.$mod.'/js/appsVUE.js';
if(file_exists($path_file)){
	echo '<script src="'.$page_url.'modulos/'.$mod.'/js/appsVUE.js"></script>';
}
?>
<?php 
sql_opciones('api_noti_chrome',$valor);
if($valor==1){noti_chrome($page_url.'apps/dashboards/notificaciones.php?opc=noti_chrome',8,20,0);}
?>
<?php
if($mod=='Home' && $opc=='ima_top'){
  $path_file='./modulos/'.$mod.'/js/app_ima_top.js';
  if(file_exists($path_file)){
	echo '<script src="'.$page_url.'modulos/'.$mod.'/js/app_ima_top.js?v='.time().'"></script>';
  }
}

if($mod=='sys' && $ext=='opciones'){
  $path_file='./modulos/'.$mod.'/js/app_opciones.js';
  if(file_exists($path_file)){
	echo '<script src="'.$page_url.'modulos/'.$mod.'/js/app_opciones.js?v='.time().'"></script>';
  }
}

if($mod=='Home' && $opc=='style_var'){
  $path_file='./modulos/'.$mod.'/js/app_style_var.js';
  if(file_exists($path_file)){
	echo '<script src="'.$page_url.'modulos/'.$mod.'/js/app_style_var.js?v='.time().'"></script>';
  }
}

/*ADMINISTRACION AJAX*/
if($mod!='' && $ext=='admin/index'){
  $op=($opc!='' && $opc!=NULL)?'_'.$opc:'';
  $path_file='modulos/'.$mod.'/js/ajax_'.$mod.$op.'.js';
  if(file_exists($path_file)){echo '<script src="'.$page_url.$path_file.'?v='.time().'"></script>';}
}
?>

</body>
</html>
<?php 
}
?>