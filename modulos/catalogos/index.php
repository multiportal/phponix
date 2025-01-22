<?php 
include 'admin/functions.php'; 
$id=$_GET['id'];
//$idp=$_GET['idp'];
?>
<style>
#tit_red{color:#D51E09;font-weight:bold;}
#des_cat{margin:4px 0px 20px 0px;}
#box_img{float:left; width:22%; margin:0 10px 0 0;}
#box_content{float:right; width:75%;}
#box_btn{}
.btn_red{color:#fff;font-weight:bold;padding:8px 12px;border-radius:8px;text-decoration:none;background:#D51E09;}
.btn_red:hover{color:#fff;text-decoration:none;}
</style>
<!--PRODUCTOS-->
<div id="Header_wrapper">
	<div id="Subheader" style="padding:70px 0;">
    	<div class="container">
        	<div class="column one">
                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
               		<div class="image_wrapper"><img class="scale-with-grid" src="<?php echo $page_url.$path_tema;?>img/cuadro_blanco.png" alt="" width="42" height="38" /></div>
                </div>
                <hr class="no_line" style="margin: 0 auto 20px;" />
            	<h1 class="title">Cat&aacute;logos</h1>
    		</div>
    	</div>
	</div>
</div>

<div style="padding:30px 0;"></div>

<div class="section mcb-section   " style="padding-top:0px; padding-bottom:20px; background-color:">
   <div class="section_wrapper mcb-section-inner">
      <div class="wrap mcb-wrap one clearfix" style="">
         <div class="mcb-wrap-inner">
            <div class="column mcb-column one-fourth column_column ">
               <div class="column_attr clearfix" style="background:#eee;">
                  <div style="margin: 30px 6% 0 0; padding:0 0 50px 22px">
					<aside id="nav_menu-2" class="widget_number_1 widget widget_nav_menu">
    					<h5 class="widget_title"><span>Categor&iacute;as</span></h5>
       					<div class="menu-categories-container">
							<?php menu_categoria();?>
    					</div>
 					</aside>
                  </div>
               </div>
            </div>
            <!--div class="column mcb-column two-fourth column_column column-content"-->
            <div class="column mcb-column two-third column_accordion ">
				<div class="column_attr clearfix" style="padding-top:10px;">
   					<div class="wrap mcb-wrap one clearfix" style="">
      					<div class="mcb-wrap-inner">
							<?php catalogos();?>
      					</div>
   					</div>
				</div>
            </div>
            <div class="column mcb-column one column_column ">
               <div class="column_attr clearfix" style="">
                  <hr class="no_line" style="margin: 0 auto 20px;">
        		  <div style="background: url(<?php echo $page_url.$path_tema;?>images/home_agro_sep.png) repeat-x; height: 3px;"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--/PRODUCTOS-->