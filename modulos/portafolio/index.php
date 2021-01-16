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
							  <?php cate_porta2();?>
                           </ul>
                           <hr>
                           <div class="clearfix portfolio-row portfolios-container portfolio-row-4 default">
							  <?php portafolio();?>                          
<!--                             
							  <article class="portfolio portfolio-grid portfolio-col-4 medias post-129 type-portfolio status-publish has-post-thumbnail hentry portfolio_cat-medias">
                                 <span class="entry-title" style="display: none;">Video</span><span class="vcard" style="display: none;"><span class="fn"><a href="http://www.portotheme.com/wordpress/porto/classic-original/author/porto_admin/" title="Posts by Joe Doe" rel="author">Joe Doe</a></span></span><span class="updated" style="display:none">2016-06-17T09:57:28+00:00</span>
                                 <div class="portfolio-item default"> <a class="text-decoration-none portfolio-link" href="http://www.portotheme.com/wordpress/porto/classic-original/portfolio/video/"> <span class="thumb-info thumb-info-lighten"> <span class="thumb-info-wrapper"> <img class="img-responsive" width="367" height="367" src="http://www.portotheme.com/wordpress/porto/classic-original/wp-content/uploads/sites/2/2016/06/project-6-367x367.jpg" alt="" /> <span class="thumb-info-title"> <span class="thumb-info-inner">Video</span> <span class="thumb-info-type">Medias</span> </span> <span class="thumb-info-action"> <span class="thumb-info-action-icon thumb-info-action-icon-primary"><i class="fa fa-link"></i></span> </span> </span> </span> </a></div>
                              </article>
-->
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
