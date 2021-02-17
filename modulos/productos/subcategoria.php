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
         <div class="col-lg-9">
            <nav class="toolbox">
               <div class="toolbox-left">
                  <div class="toolbox-item toolbox-sort">
                     <div class="select-custom">
                        <select name="orderby" class="form-control">
                           <option value="menu_order" selected="selected">Default sorting</option>
                           <option value="popularity">Sort by popularity</option>
                           <option value="rating">Sort by average rating</option>
                           <option value="date">Sort by newness</option>
                           <option value="price">Sort by price: low to high</option>
                           <option value="price-desc">Sort by price: high to low</option>
                        </select>
                     </div>
                     <!-- End .select-custom -->
                     <a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
                  </div>
                  <!-- End .toolbox-item -->
               </div>
               <!-- End .toolbox-left -->
               <div class="toolbox-item toolbox-show">
                  <label>Resultados 1-999</label>
               </div>
               <!-- End .toolbox-item -->
               <div class="layout-modes">
                  <a href="category.html" class="layout-btn btn-grid active" title="Grid">
                  <i class="icon-mode-grid"></i>
                  </a>
                  <a href="category-list.html" class="layout-btn btn-list" title="List">
                  <i class="icon-mode-list"></i>
                  </a>
               </div>
               <!-- End .layout-modes -->
            </nav>
            <div class="row row-sm">
               
               <!--Item-Productos-->
                <?php item_subproductos($id,$idp);?>
               <!--/Item-Productos-->
                              
            </div>
            <!-- End .row -->
            <nav class="toolbox toolbox-pagination">
               <div class="toolbox-item toolbox-show">
                  <label>Resultados 1-999</label>
               </div>
               <!-- End .toolbox-item -->
               <!--ul class="pagination">
                  <li class="page-item disabled">
                     <a class="page-link page-link-btn" href="#"><i class="icon-angle-left"></i></a>
                  </li>
                  <li class="page-item active">
                     <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><span>...</span></li>
                  <li class="page-item"><a class="page-link" href="#">15</a></li>
                  <li class="page-item">
                     <a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
                  </li>
               </ul-->
            </nav>
         </div>
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
                     <h3 class="widget-title">Productos</h3>
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

