<?php include 'admin/functions.php';
$id=$_GET['id'];
one_portafolio($id,$datos_porta);

if(!empty($datos_porta)){
?>
<section class="page-top page-header-1">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="breadcrumbs-wrap">
               <ul class="breadcrumb">
                  <li class="home" itemscope="" itemtype="http://schema.org/BreadcrumbList"><a itemprop="url" href="<?php echo $page_url;?>" title="Go to Home Page"><span itemprop="title">Home</span></a><i class="delimiter"></i></li>
                  <li itemscope="" itemtype="http://schema.org/BreadcrumbList"><a itemprop="url" href="<?php echo $page_url;?>"><span itemprop="title">Portafolio</span></a><i class="delimiter"></i></li>
                  <li><?php echo $datos_porta[2];?></li>
               </ul>
            </div>
            <div class="">
               <h1 class="page-title"><?php echo $datos_porta[2];?></h1>
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
                           <h2 class="entry-title shorter"><?php echo $datos_porta[2];?></h2>
                        </div>
                        <div class="portfolio-nav col-lg-1">
<!--
                           <a href="#" rel="prev">
                              <div data-tooltip="" title="" class="portfolio-nav-prev" data-original-title="Previous"><i class="fa"></i></div>
                           </a>
                           <a href="#" rel="next">
                              <div data-tooltip="" title="" class="portfolio-nav-next" data-original-title="Next"><i class="fa"></i></div>
                           </a>
-->
                        </div>
                     </div>
                  </div>
                  <hr class="tall">
                  <span class="vcard" style="display: none;"><span class="fn"><a href="" title="Posts by Joe Doe" rel="author">Joe Doe</a></span></span><span class="updated" style="display:none">2016-06-17T10:04:21+00:00</span>
                  <div class="row">
					 <div class="col-lg-6">
    					<div class="portfolio-image">
    						<div class="portfolio-slideshow porto-carousel owl-carousel">
<?php if($datos_porta[6]!=''){?>
        						<div>
        							<div class="img-thumbnail"> <img class="owl-lazy img-responsive" width="1000" height="1000" data-src="<?php echo $page_url.'modulos/portafolio/fotos/'.$datos_porta[6];?>" alt="" /> <span class="zoom" data-src="<?php echo $page_url.'modulos/portafolio/fotos/'.$datos_porta[6];?>" data-title=""><i class="fa fa-search"></i></span></div>
        						</div>
<?php }?>

        					</div> 
     					</div>
 					 </div>

                     <div class="col-lg-6">
                        <div class="portfolio-info m-t-none pt-none">
                           <ul>
                              <li> <i class="fa fa-calendar"></i> <?php echo $datos_porta[3];?></li>
                              <li> <i class="fa fa-tags"></i> <a href="<?php echo $page_url.'index.php#'.$datos_porta[5];?>" rel="tag"><?php echo $cate=str_replace('_',' ',$datos_porta[5]);?></a></li>
                           </ul>
                        </div>
                        <h5 class="m-t-md portfolio-desc">Descripci&oacute;n del Proyecto</h5>
                           <!--Reseña-->
                           <?php echo $datos_porta[4];?>
                           <!--Reseña-->

                        <div class="post-gap-small"></div>
                        <a target="_blank" class="btn btn-primary btn-icon" href="<?php echo $datos_porta[11];?>"> <i class="fa fa-external-link"></i>Ver P&aacute;gina </a><span data-appear-animation-delay="800" data-appear-animation="rotateInUpLeft" class="dir-arrow hlb appear-animation rotateInUpLeft appear-animation-visible" style="animation-delay: 800ms;"></span>

                     </div>
                  </div>
                  
                  <div class=""></div>
               </article>
               <hr class="tall">
               <!--div class="related-portfolios ">
                  <h4 class="sub-title">Related <strong>Work</strong></h4>
                  <div class="row">
                     <div class="portfolio-carousel porto-carousel owl-carousel show-nav-title owl-loaded owl-drag" data-plugin-options="{&quot;themeConfig&quot;:true,&quot;lg&quot;:&quot;4&quot;,&quot;md&quot;:3,&quot;sm&quot;:2}">
                        <div class="owl-stage-outer owl-height" style="height: 275px; margin-left: 0px; margin-right: 0px;">
                           <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 570px;">
                              <div class="owl-item active" style="width: 285px;">
                                 <div class="portfolio-item "> <a class="text-decoration-none" href="http://www.portotheme.com/wordpress/porto/classic-original/portfolio/gallery/"> <span class="thumb-info thumb-info-lighten"> <span class="thumb-info-wrapper"> <img class="img-responsive" width="367" height="367" src="http://www.portotheme.com/wordpress/porto/classic-original/wp-content/uploads/sites/2/2016/06/project-1-2-367x367.jpg" alt=""> <span class="thumb-info-title"> <span class="thumb-info-inner">Gallery</span> <span class="thumb-info-type">Brand</span> </span> <span class="thumb-info-action"> <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span> </span> <span class="zoom" data-src="http://www.portotheme.com/wordpress/porto/classic-original/wp-content/uploads/sites/2/2016/06/project-1-2.jpg" data-title=""><i class="fa fa-search"></i></span> </span> </span> </a></div>
                              </div>
                              <div class="owl-item active" style="width: 285px;">
                                 <div class="portfolio-item "> <a class="text-decoration-none" href="http://www.portotheme.com/wordpress/porto/classic-original/portfolio/full-images/"> <span class="thumb-info thumb-info-lighten"> <span class="thumb-info-wrapper"> <img class="img-responsive" width="367" height="367" src="http://www.portotheme.com/wordpress/porto/classic-original/wp-content/uploads/sites/2/2016/06/project-1-short-367x367.jpg" alt=""> <span class="thumb-info-title"> <span class="thumb-info-inner">Full Images</span> <span class="thumb-info-type">Brand</span> </span> <span class="thumb-info-action"> <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span> </span> <span class="zoom" data-src="http://www.portotheme.com/wordpress/porto/classic-original/wp-content/uploads/sites/2/2016/06/project-1-short.jpg" data-title=""><i class="fa fa-search"></i></span> </span> </span> </a></div>
                              </div>
                           </div>
                        </div>
                        <div class="owl-nav disabled">
                           <div class="owl-prev"></div>
                           <div class="owl-next"></div>
                        </div>
                        <div class="owl-dots disabled">
                           <div class="owl-dot active"><span></span></div>
                        </div>
                     </div>
                  </div>
               </div-->
               
            </div>
         </div>
         <!-- end main content -->
      </div>
   </div>
</div>
<?php
}else{
	echo '<div class="col-lg-12 col-xs-12">
			<div>Por el momento no hay informaci&oacute;n disponible.</div>
		</div>
  ';
}
?>