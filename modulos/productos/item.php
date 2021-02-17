<?php 
include 'admin/functions.php'; 
$id=$_GET['id'];
?>
<style>
.light-title{color:#444 !important; font-weight:600; padding-left:25px; font-size:20px;}
.nav.nav-tabs .nav-item .nav-link{color:#555 !important; font-family: Open Sans, sans-serif;text-transform:capitalize; font-weight:700;}
.nav.nav-tabs .nav-item.show .nav-link, .nav.nav-tabs .nav-item .nav-link.active{color:#77BD1E !important;}
.nav.nav-tabs .nav-item+.nav-item{margin-left:3.4rem;}
.product-title{color:#444!important;height:inherit;font-weight:700;margin-bottom:5px!important;}
.sub-tit{text-transform:uppercase;color:#888;font-weight:200; margin-bottom:2px;}
.codigo-box2{font-size:16px;color: #77BD1E;margin-bottom: 10px;font-weight: 600;}
.product-single-details .price-box{color:#444;}
.product-single-details .product-desc{border-bottom:0px;}
.prod-thumbnail .active img, .prod-thumbnail img:hover{border:2px solid #bbb;}
.nav.nav-tabs{border-bottom: .2rem solid #666;}
</style>

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
            
<div class="mb-5"></div>

<!--ITEM-->
<div class="container">
   <div class="row">
   	  <?php one_producto($id);?>
      <div class="sidebar-overlay"></div>
      <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
      <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
         <div class="sidebar-wrapper">
 			<?php include '_soporte.php';?>
			<?php include '_destacados.php';?>
         </div>
      </aside>
      <!-- End .col-md-3 -->
   </div>
   <!-- End .row -->
</div>
<!-- End .container -->
<?php include '_interes.php';?>
<!--/ITEM-->

