<?php include 'admin/functions.php';
$id=$_GET['id'];
$row=sql_row($tabla,'ID',$id);
$cover=$row['cover'];
$replace=array(' ','.',',','(',')');
$nombre=str_replace($replace,"-",$row['nombre']);
$FT=$row['FT'];
$descripcion=$row['descripcion'];
$cate=$row['cate'];
$url_p=$row['url_page'];
$imagen1=$row['imagen1'];
$imagen2=$row['imagen2'];
$imagen3=$row['imagen3'];
$imagen4=$row['imagen4'];
$imagen5=$row['imagen5'];
$visible=$row['visible'];
      
if(!empty($row) && $visible!=0){
?>
<section class="page-top page-header-1">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="breadcrumbs-wrap">
               <ul class="breadcrumb">
                  <li class="home" itemscope="" itemtype="http://schema.org/BreadcrumbList"><a itemprop="url" href="<?php echo $page_url;?>" title="Go to Home Page"><span itemprop="title">Home</span></a><i class="delimiter"></i></li>
                  <li itemscope="" itemtype="http://schema.org/BreadcrumbList"><a itemprop="url" href="<?php echo $page_url;?>"><span itemprop="title">Portafolio</span></a><i class="delimiter"></i></li>
                  <li><?php echo $nombre;?></li>
               </ul>
            </div>
            <div class="">
               <h1 class="page-title"><?php echo $nombre;?></h1>
            </div>
         </div>
      </div>
   </div>
</section>
<div id="main" class="column1 boxed">
   <!-- main -->
   <div class="container">
      <div class="row main-content-wrap opened">
         <!-- main content -->
         <div class="main-content col-lg-12">
            <div class="full-width"></div>
            <div id="content" role="main" class="">
               <article class="portfolio-large post-126 portfolio type-portfolio status-publish has-post-thumbnail hentry portfolio_cat-brand portfolio_skills-backend portfolio_skills-logo">
                  <div class="portfolio-title">
                     <div class="row">
                        <div class="portfolio-nav-all col-lg-1"> <a title="" data-tooltip="" href="<?php echo $page_url;?>index.php" data-original-title="Back to list"><i class="fa fa-th"></i></a></div>
                        <div class="col-lg-10 text-center">
                           <h2 class="entry-title shorter"><?php echo $nombre;?></h2>
                        </div>
                        <div class="portfolio-nav col-lg-1"></div>
                     </div>
                  </div>
                  <hr class="tall">
                  <span class="vcard" style="display: none;"><span class="fn"><a href="" title="Posts by Joe Doe" rel="author">Joe Doe</a></span></span><span class="updated" style="display:none">2016-06-17T10:04:21+00:00</span>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="portfolio-image">
                           <div class="portfolio-slideshow porto-carousel owl-carousel">
                              <?php if($imagen1!=''){?>
                              <div>
                                 <div class="img-thumbnail"> <img class="owl-lazy img-responsive" width="1000" height="1000" data-src="<?php echo $page_url.'modulos/portafolio/fotos/'.$imagen1;?>" alt="" /> <span class="zoom" data-src="<?php echo $page_url.'modulos/portafolio/fotos/'.$imagen1;?>" data-title=""><i class="fa fa-search"></i></span></div>
                              </div>
                              <?php }?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="portfolio-info m-t-none pt-none">
                           <ul>
                              <li> <i class="fa fa-calendar"></i> <?php echo $FT;?></li>
                              <li> <i class="fa fa-tags"></i> <a href="<?php echo $page_url.'index.php#'.$cate;?>" rel="tag"><?php echo $cate=str_replace('_',' ',$cate);?></a></li>
                           </ul>
                        </div>
                        <h5 class="m-t-md portfolio-desc">Descripci&oacute;n del Proyecto</h5>
                        <!--Reseña-->
                        <?php echo $descripcion;?>
                        <!--Reseña-->
                        <div class="post-gap-small"></div>
                        <a target="_blank" class="btn btn-primary btn-icon" href="<?php echo $url_p;?>"> <i class="fa fa-external-link"></i>Ver P&aacute;gina </a><span data-appear-animation-delay="800" data-appear-animation="rotateInUpLeft" class="dir-arrow hlb appear-animation rotateInUpLeft appear-animation-visible" style="animation-delay: 800ms;"></span>
                     </div>
                  </div>
                  <div class=""></div>
               </article>
               <hr class="tall">
            </div>
         </div>
         <!-- end main content -->
      </div>
   </div>
</div>
<?php
}else{
 	echo '<div class="col-lg-12 col-xs-12"><div>Por el momento no hay informaci&oacute;n disponible.</div></div>';
}
?>