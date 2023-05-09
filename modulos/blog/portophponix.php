<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
   <div class="container">
      <div class="row">
         <div class="col-md-12 align-self-center p-static order-2 text-center">
            <h1 class="text-dark font-weight-bold text-8">Blog</h1>
            <span class="sub-title text-dark">Check out our Latest News!</span>
         </div>
         <div class="col-md-12 align-self-center order-1">
            <ul class="breadcrumb d-block text-center">
               <li><a href="<?php echo $page_url;?>">Home</a></li>
               <li class="active"><?php echo $mod;?></li>
            </ul>
         </div>
      </div>
   </div>
</section>
<?php 
   if($ext=='topic'){
   ?>
<div class="container py-4">
   <div class="row">
      <div class="col-lg-3 order-lg-2">
         <aside class="sidebar">
            <form action="page-search-results.html" method="get">
               <div class="input-group mb-3 pb-1">										<input class="form-control text-1" placeholder="Search..." name="s" id="s" type="text">										<span class="input-group-append">											<button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>										</span>									</div>
            </form>
            <h5 class="font-weight-bold pt-4">Categories</h5>
            <ul class="nav nav-list flex-column mb-5">
               <li class="nav-item"><a class="nav-link" href="#">Design (2)</a></li>
               <li class="nav-item">
                  <a class="nav-link active" href="#">Photos (4)</a>										
                  <ul>
                     <li class="nav-item"><a class="nav-link" href="#">Animals</a></li>
                     <li class="nav-item"><a class="nav-link active" href="#">Business</a></li>
                     <li class="nav-item"><a class="nav-link" href="#">Sports</a></li>
                     <li class="nav-item"><a class="nav-link" href="#">People</a></li>
                  </ul>
               </li>
               <li class="nav-item"><a class="nav-link" href="#">Videos (3)</a></li>
               <li class="nav-item"><a class="nav-link" href="#">Lifestyle (2)</a></li>
               <li class="nav-item"><a class="nav-link" href="#">Technology (1)</a></li>
            </ul>
            <div class="tabs tabs-dark mb-4 pb-2">
               <ul class="nav nav-tabs">
                  <li class="nav-item active"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#popularPosts" data-toggle="tab">Popular</a></li>
                  <li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">Recent</a></li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="popularPosts">
                     <ul class="simple-post-list">
                        <li>
                           <div class="post-image">
                              <div class="img-thumbnail img-thumbnail-no-borders d-block">															<a href="blog-post.html">																<img src="<?php echo $page_url;?>modulos/blog/fotos/nodisponible.jpg" width="50" height="50" alt="">															</a>														</div>
                           </div>
                           <div class="post-info">
                              <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>														
                              <div class="post-meta">															 Nov 10, 2020														</div>
                           </div>
                        </li>
                        <li>
                           <div class="post-image">
                              <div class="img-thumbnail img-thumbnail-no-borders d-block">															<a href="blog-post.html">																<img src="<?php echo $page_url;?>modulos/blog/fotos/nodisponible.jpg" width="50" height="50" alt="">															</a>														</div>
                           </div>
                           <div class="post-info">
                              <a href="blog-post.html">Vitae Nibh Un Odiosters</a>														
                              <div class="post-meta">															 Nov 10, 2020														</div>
                           </div>
                        </li>
                        <li>
                           <div class="post-image">
                              <div class="img-thumbnail img-thumbnail-no-borders d-block">															<a href="blog-post.html">																<img src="<?php echo $page_url;?>modulos/blog/fotos/nodisponible.jpg" width="50" height="50" alt="">															</a>														</div>
                           </div>
                           <div class="post-info">
                              <a href="blog-post.html">Odiosters Nullam Vitae</a>														
                              <div class="post-meta">															 Nov 10, 2020														</div>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="tab-pane" id="recentPosts">
                     <ul class="simple-post-list">
                        <li>
                           <div class="post-image">
                              <div class="img-thumbnail img-thumbnail-no-borders d-block">															<a href="blog-post.html">																<img src="<?php echo $page_url;?>modulos/blog/fotos/nodisponible.jpg" width="50" height="50" alt="">															</a>														</div>
                           </div>
                           <div class="post-info">
                              <a href="blog-post.html">Vitae Nibh Un Odiosters</a>														
                              <div class="post-meta">															 Nov 10, 2020														</div>
                           </div>
                        </li>
                        <li>
                           <div class="post-image">
                              <div class="img-thumbnail img-thumbnail-no-borders d-block">															<a href="blog-post.html">																<img src="<?php echo $page_url;?>modulos/blog/fotos/nodisponible.jpg" width="50" height="50" alt="">															</a>														</div>
                           </div>
                           <div class="post-info">
                              <a href="blog-post.html">Odiosters Nullam Vitae</a>														
                              <div class="post-meta">															 Nov 10, 2020														</div>
                           </div>
                        </li>
                        <li>
                           <div class="post-image">
                              <div class="img-thumbnail img-thumbnail-no-borders d-block">															<a href="blog-post.html">																<img src="<?php echo $page_url;?>modulos/blog/fotos/nodisponible.jpg" width="50" height="50" alt="">															</a>														</div>
                           </div>
                           <div class="post-info">
                              <a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>														
                              <div class="post-meta">															 Nov 10, 2020														</div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <h5 class="font-weight-bold pt-4">About Us</h5>
            <p>Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Nulla nunc dui, tristique in semper vel. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. </p>
            <h5 class="font-weight-bold pt-4">Latest from Twitter</h5>
            <!--div id="tweet" class="twitter mb-4" data-plugin-tweets data-plugin-options="{'username': 'oklerthemes', 'count': 2}">
               <p>Please wait...</p>
            </div-->
            <h5 class="font-weight-bold pt-4">Photos from Instagram</h5>
            <div class="instagram-feed" data-type="nomargins" class="mb-4 pb-1"></div>
            <h5 class="font-weight-bold pt-4 mb-2">Tags</h5>
            <div class="mb-3 pb-1">									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">design</span></a>									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">brands</span></a>									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">video</span></a>									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">business</span></a>									<a href="#"><span class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">travel</span></a>								</div>
            <h5 class="font-weight-bold pt-4">Find us on Facebook</h5>
            <!--div class="fb-page" data-href="https://www.facebook.com/OklerThemes/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">
               <blockquote cite="https://www.facebook.com/OklerThemes/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/OklerThemes/">Okler Themes</a></blockquote>
            </div-->
         </aside>
      </div>
      <div class="col-lg-9 order-lg-1">
         <div class="blog-posts single-post">
            <article class="post post-large blog-single-post border-0 m-0 p-0">
               <div class="post-image ml-0">
                  <a href="blog-post.html">
                  <img src="<?php echo $page_url.'modulos/blog/fotos/'.$cover;?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                  </a>
               </div>
               <div class="post-date ml-0">
                  <span class="day">10</span>
                  <span class="month">Jan</span>
               </div>
               <div class="post-content ml-0">
                  <h2 class="font-weight-bold"><a href="blog-post.html"><?php echo $titulo;?></a></h2>
                  <div class="post-meta">
                     <span><i class="far fa-user"></i> Por <a href="#"><?php echo $autor;?></a> </span>
                     <span><i class="far fa-folder"></i> <?php echo $tag;?> </span>
                     <span><i class="far fa-comments"></i> <a href="#">12 Comentarios</a></span>
                  </div>
                  <div>
					  <?php echo $contenido;?>
				  </div>

                  <div id="comments" class="post-block mt-5 post-comments">
                     <ul id="form_coment_div" class="comments">
                     </ul>
                  </div>
                  <div class="post-block mt-5 post-leave-comment">
                     <h4 class="mb-3">Dejanos tus comentarios</h4>
                     <form id="form_coment" class="contact-form p-4 rounded bg-color-grey" method="POST">
                        <div class="p-2">
                           <div class="form-row">
                              <div class="form-group col-lg-6">
                                 <label class="required font-weight-bold text-dark">Nombre</label>
                                 <input type="text" name="nom" id="nom" value="" placeholder="Nombre (*)" data-msg-required="Please enter your name." maxlength="100" class="form-control" required>
                              </div>
                              <div class="form-group col-lg-6">
                                 <label class="required font-weight-bold text-dark">Email</label>
                                 <input type="email" name="email" id="email" value="" placeholder="Correo (*)" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" required>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col">
                                 <label class="required font-weight-bold text-dark">Comentario</label>
                                 <textarea name="comment" id="comment" maxlength="500" data-msg-required="Please enter your message." rows="8" class="form-control" required></textarea>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="form-group col mb-0">
                                 <input type="button" id="btn-ingresar" value="Enviar" class="btn btn-primary btn-modern" data-loading-text="Loading...">
                                 <input type="hidden" name="fecha" id="fecha" value="<?php echo $date;?>">
                                 <input type="hidden" name="id_b" id="id_b" value="<?php echo $id;?>">
                                 <input type="hidden" name="ip" id="ip" value="<?php echo $ip;?>">
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </article>
         </div>
      </div>
   </div>
</div>
<?php
   }else{
   ?>
<div class="container py-4">
   <div class="row">
      <div class="col">
         <div class="blog-posts">
            <div class="row">
               <?php blog();?>
            </div>
            <div class="row">
               <div class="col">
                  <ul class="pagination float-right">
                     <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
                     <li class="page-item active"><a class="page-link" href="#">1</a></li>
                     <li class="page-item"><a class="page-link" href="#">2</a></li>
                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                     <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php }?>