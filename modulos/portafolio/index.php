<?php include 'admin/functions.php';?>
<section class="page-top page-header-1">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="breadcrumbs-wrap">
               <ul class="breadcrumb">
                  <li class="home" itemscope itemtype="http://schema.org/BreadcrumbList"><a itemprop="url" href="<?php $page_url;?>" title="Go to Home Page"><span itemprop="title">Home</span></a><i class="delimiter"></i></li>
                  <li itemscope itemtype="http://schema.org/BreadcrumbList"><span itemprop="title">Portafolios</span></li>
               </ul>
            </div>
            <div class="">
               <h1 class="page-title">Portafolios</h1>
            </div>
         </div>
      </div>
   </div>
</section>
<div id="main" class="column1 boxed">
   <!-- main -->
   <div class="container">
      <div class="row main-content-wrap">
         <!-- main content -->
         <div class="main-content col-lg-12">
            <div id="content" role="main" class="">
               <h2>Nuestros <strong>Projectos</strong></h2>
               <div class="page-portfolios portfolios-grid clearfix hubdata">
                  <ul class="portfolio-filter nav nav-pills sort-source">
                     <li class="active" data-filter="*"><a href="#">Todos</a></li>
                     <?php categorias();?>
                  </ul>
                  <hr>
                  <div class="clearfix portfolio-row portfolios-container portfolio-row-4 default" style="min-height:100px">
                     <?php portafolio();?> 
                  </div>
                  <div class="clearfix"></div>
                  <div class="pagination-wrap">
                     <div class="pagination" role="navigation"> <span aria-current='page' class='page-numbers current'>1</span><a class='page-numbers' href='#2'>2</a><a class='page-numbers' href='#3'>3</a><a class="next page-numbers" href="#2">Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i></a></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end main content -->
      </div>
   </div>
</div>
<!-- end main -->