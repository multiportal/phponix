<?php include 'admin/functions.php';?>
<?php 
$id=$_GET['id'];
$sql=mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."blog WHERE ID='{$id}' AND visible=1;") or print mysqli_error($mysqli); 
$num_rows = mysqli_num_rows($sql);
  if($num_rows!=0){
	if($row=mysqli_fetch_array($sql)){
		$cover=$row['cover'];
		$titulo=$row['titulo'];
		$descripcion=$row['descripcion'];
		$contenido=$row['contenido'];
		$tag=$row['tag'];
		$autor=$row['autor'];
		$fecha=$row['fecha'];
	}
  }//else{}
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
                  <!--
                  <div class="social-meta-wrap">
                     <div class="divider">
                        <h3>Compartir</h3>
                     </div>
                     <ul class="social-meta">
                        <li><a class="facebook-share" href="https://www.facebook.com/sharer/sharer.php?u=https://www.manprec.com/que-concentrador-de-oxigeno-escoger-aqui-un-articulo-sobre-everflo-vs-millenium/" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter-share" href="https://twitter.com/share?text=¿Qué concentrador de oxígeno escoger? Aquí un artículo sobre EverFlo vs. Millenium&amp;url=https://www.manprec.com/que-concentrador-de-oxigeno-escoger-aqui-un-articulo-sobre-everflo-vs-millenium/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="google-share" href="https://plus.google.com/share?url=https://www.manprec.com/que-concentrador-de-oxigeno-escoger-aqui-un-articulo-sobre-everflo-vs-millenium/" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a></li>
                        <li><a class="pinterest-share" href="//pinterest.com/pin/create/button/?url=https://www.manprec.com/que-concentrador-de-oxigeno-escoger-aqui-un-articulo-sobre-everflo-vs-millenium/&amp;media=https://www.manprec.com/wp-content/uploads/2017/12/MillenniumM10FrontPanel_RGBLo.jpg&amp;description=¿Qué concentrador de oxígeno escoger? Aquí un artículo sobre EverFlo vs. Millenium"><i class="fa fa-pinterest"></i></a></li>
                     </ul>
                  </div>
                  -->
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
<!--?php include 'form_coment.php';?-->
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
	var $ = jQuery.noConflict();
    $(document).on('ready',function(){
      $('#btn-ingresar').click(function(e){
		e.preventDefault();
        var url = "<?php echo $page_url;?>modulos/blog/form_coment.php";                                      
        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#form_coment").serialize(),
           success: function(data){
             $('#form_coment_div').html(data);
			 $('#form_coment').trigger("reset");           
           }
         });
      });
    });
    </script>

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
                                 <input type="text" name="email" id="email" value="" size="22" placeholder="Correo (*)">
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
    
	<div id="form_coment_div"></div>

<?php
echo '<script>
/* Parametros mandatorios */
    var seconds = 1; // el tiempo en que se refresca
	var divid = "contenido"; // el div que quieres actualizar!
	var url = "'.$page_url.'modulos/blog/comentarios.php?id='.$id.'"; // el archivo que ira en el div

	function refreshdiv(){
		// The XMLHttpRequest object
		var xmlHttp;
		try{
			xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
		}
		catch (e){
			try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
			}
			catch (e){
				try{
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
					alert("Tu explorador no soporta AJAX.");
					return false;
				}
			}
		}
		// Timestamp for preventing IE caching the GET request
		var timestamp = parseInt(new Date().getTime().toString().substring(0, 10));
		var nocacheurl = url+"?t="+timestamp;
		// The code...
		xmlHttp.onreadystatechange=function(){
			if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
				document.getElementById(divid).innerHTML=xmlHttp.responseText;
				setTimeout(\'refreshdiv()\',seconds*1000);
			}
		}
		xmlHttp.open("GET",nocacheurl,true);
		xmlHttp.send(null);
	}
	// Empieza la función de refrescar
	window.onload = function(){
		refreshdiv(); // corremos inmediatamente la funcion
	}
</script>';
?>
<div class="lm-col-12">
<div id="contenido">
<h3>Refrescar una div tag con Ajax</h3>
// Aqui el Div en el que se coloca el contenido de comentarios.php
<div name="timediv" id="timediv"></div>
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