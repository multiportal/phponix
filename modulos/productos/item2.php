<?php 
include 'admin/functions.php'; 
$id=$_GET['id'];
?>
            <div class="page-header page-header-bg" style="background-image: url('<?php echo $page_url.'modulos/'.$mod.'/img/top-banner.png';?>');">
                <div class="container">
                    <h1><span>M&aacute;s de 3000+</span>
                        PRODUCTOS</h1>
                    <a href="<?php echo $btn1;?>" class="btn-cer">Cont&aacute;ctanos</a>
                </div><!-- End .container -->
            </div><!-- End .page-header -->

            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb mt-0">
            			<li class="breadcrumb-item"><a href="<?php echo $page_url;?>index.php"><i class="icon-home"></i></a></li>
						<?php menu_rutas_productos($id);?>
                    </ol>
                </div><!-- End .container -->
            </nav>

   <div class="container">
      <div class="row">
               
               <!--Item-Productos-->
                <?php one_producto2($id);?>
                <?php include 'relacionado.php';?>
                </div>
               <!--/Item-Productos-->

         <!-- End .col-lg-9 -->
         <aside class="sidebar-shop col-lg-3 order-lg-first">
            <div class="pin-wrapper" style="height: 1361px;">
               <div class="sidebar-wrapper sticky-active" style="border-bottom: 0px none rgb(122, 125, 130); width: 270px;">
                  <!--
                  <div class="widget">
                     <h3 class="widget-title">
                        <a data-toggle="collapse" href="#widget-body-1" role="button" aria-expanded="true" aria-controls="widget-body-1" class="">electronics</a>
                     </h3>
                     <div class="collapse show" id="widget-body-1" style="">
                        <div class="widget-body">
                           <ul class="cat-list">
                              <li><a href="#">Smart TVs</a></li>
                              <li><a href="#">Cameras</a></li>
                              <li><a href="#">Head Phones</a></li>
                              <li><a href="#">Games</a></li>
                           </ul>
                        </div>
                        <!-- End .widget-body ->
                     </div>
                     <!-- End .collapse ->
                  </div>
                  <!-- End .widget -->
                  <div class="widget widget-block" style="padding:2.3rem 0rem 1.8rem !important;">
                     <h3 class="widget-title">Categorias</h3>
					<?php menu_categoria();?>
                  </div>
                  <!-- End .widget -->
				  <?php include 'nuevo.php';?>
                  
               </div>
            </div>
            <!-- End .sidebar-wrapper -->
         </aside>
         <!-- End .col-lg-3 -->
      </div>
      <!-- End .row -->
   </div>
   <!-- End .container -->
   <div class="mb-5"></div>
   <!-- margin -->


