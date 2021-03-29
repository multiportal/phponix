<?php 
if($ext=='topic'){
?>
<div id="page-title-wrap" style="background-image:url();background-color:#03F;" class="header-dark has-thumb">
  <div class="page-title">
    <h1><?php echo $titulo;?></h1>
    <div class="meta-wrap">
      <div class="meta"><?php echo $fecha;?></div>
      <div class="meta"><?php echo $tag;?></div>
    </div>
  </div>
</div>
<div class="container crumbs-wrap">
  <!-- BEGIN row -->
  <div class="row">
    <!-- BEGIN col-12 -->
    <div class="lm-col-12">
      <nav class="crumbs"><span>You are here:</span><a class="home" href="<?php echo $page_url;?>">Home</a>  / <a href="<?php echo $page_url.'blog';?>">blog</a> / <span><?php echo $titulo;?></span></nav>
    </div>
    <!-- END col-12 -->
  </div>
  <!-- END row -->
</div>
<!-- BEGIN #page -->
<div id="page" class="hfeed">
  <!-- BEGIN #main -->
  <div id="main" class="container">
    <!-- BEGIN row -->
    <div class="row default sidebar-right">
      <!-- BEGIN col-9/12 -->
      <div class="cont lm-col-9">
        <!-- BEGIN #content -->
        <div id="content" role="main">
          <!-- BEGIN #post -->
          <article id="post-1126786" class="post-1126786 post type-post status-publish format-standard has-post-thumbnail hentry category-concentradores-de-oxigeno">
            <!-- BEGIN .entry-thumbnail -->
            <div class="entry-thumbnail">
              <img width="300" height="400" src="<?php echo $page_url.'modulos/blog/fotos/'.$cover;?>" class="attachment-post-thumb size-post-thumb wp-post-image" alt="<?php echo $tag;?>" srcset="<?php echo $page_url.'modulos/blog/fotos/'.$cover;?> 300w, <?php echo $page_url.'modulos/blog/fotos/'.$cover;?> 225w" sizes="(max-width: 300px) 100vw, 300px">
            </div>
            <!-- END .entry-thumbnail -->
            <!-- END .entry-header -->
            <!-- BEGIN .entry-conent -->
            <div class="entry-content">
              <?php echo $contenido;?>
            </div>
            <!-- END .entry-conent -->
          </article>
          <!-- END #post -->
          <section id="comments">
            <div id="respond">
              <div class="divider">
                <h3>DEJA UN COMENTARIO</h3>
              </div>
              <div class="cancel-comment-reply">
                <a rel="nofollow" id="cancel-comment-reply-link" href="/que-concentrador-de-oxigeno-escoger-aqui-un-articulo-sobre-everflo-vs-millenium/#respond" style="display:none;">Clic para cancelar respuesta.</a>				
              </div>
              <form id="form_coment" method="POST">
                <div class="row">
                  <div class="lm-col-6">
                    <p class="comment-input">
                      <label for="nom">Nombre <span>(*)</span></label>
                      <input type="text" name="nom" id="nom" value="" size="22" placeholder="Nombre (*)">
                    </p>
                  </div>
                  <div class="lm-col-6">
                    <p class="comment-input">
                      <label for="email">Correo <span>(*)</span></label>
                      <input type="email" name="email" id="email" value="" size="22" placeholder="Correo (*)">
                    </p>
                  </div>
                </div>
                <p class="comment-textarea">
                  <textarea name="comment" id="comment" cols="58" rows="6" placeholder="Escribe un comentario..."></textarea>
                </p>
                <p class="comment-submit">
                  <!--input type="submit" name="enviar" id="enviar" class="" value="Enviar"-->
                  <input type="button" id="btn-ingresar" value="Enviar" />
                  <input type="hidden" name="fecha" id="fecha" value="<?php echo $date;?>">
                  <input type="hidden" name="id_b" id="id_b" value="<?php echo $id;?>">
                  <input type="hidden" name="ip" id="ip" value="<?php echo $ip;?>">
                </p>
              </form>
              <div id="aviso"></div>
              <div id="form_coment_div">
                <div class="lm-col-12">                 
                  <div id="contenido">
                    // Aqui el Div en el que se coloca el contenido de comentarios
                    <div name="timediv" id="timediv"></div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <!-- END #content -->
      </div>
      <!-- END col-9 -->
      <!-- BEGIN col-3 -->
      <div class="lm-col-3">
        <!-- BEGIN #sidebar -->
        <div id="sidebar" role="complementary">
          <!-- BEGIN sidebar -->
          <aside id="recent-posts-2" class="widget widget_recent_entries">
            <div class="widget-header">
              <h3 class="widget-title">Publicaciones recientes</h3>
            </div>
            <ul>
              <?php sidebar_blog();?>
            </ul>
          </aside>
          <!-- END sidebar -->
        </div>
        <!-- END #sidebar -->
        <!-- END col-3 -->
      </div>
      <!-- END row -->
    </div>
  </div>
  <!-- END #main -->
</div>
<!-- END #page -->
<?php
}else{
?>
<style>
.blog, h2{text-align:center; font-weight:bold;}
.img-resp{width:100%; border:0;}
.titb{height:35px;}
.btn_azul {
    font-weight: bold;
    color: #fff;
    background: #0084ff;
    padding: 12px 25px;
    border-radius: 8px;
    border: 1px solid #0084ff;
    font-size: 1.8rem;
}
.btn_azul:hover {
    border: 1px solid #fff;
}
.new-font2{height:60px;}
.space{float:left;height:50px;}
.h-item{height:390px;}
</style>
<div class="container">
	<div class="col-lg-12 col-xs-12 blog"><h2><stong>BLOG</strong></h2></div>
	<?php blog();?>
    <div class="col-lg-12 col-xs-12 space"></div>
</div>
<?php }?>