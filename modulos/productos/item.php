<?php 
include 'admin/functions.php'; 
$id=$_GET['id'];
?>
<style>
.sc_team .sc_team_item .sc_team_item_info{ padding:1px 20px !important;}
</style>
<div class="page_content_wrap">
	<div class="content">
<!--PRODUCTOS-->
<div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-3" style="padding:85px 0px 85px 60px">
<!--SIDEBAR-->
<div class="sidebar widget_area bg_tint_light sidebar_style_light" role="complementary">
	<aside id="nav_menu-2" class="widget_number_1 widget widget_nav_menu">
    	<h5 class="widget_title">Categorias</h5>
       	<div class="menu-categories-container">
			<?php menu_categoria();?>
    	</div>
 	</aside>
    <!--aside id="tag_cloud-2" class="widget_number_4 widget widget_tag_cloud">
    	<h5 class="widget_title">Tags</h5>
        <div class="tagcloud">
        	<a href="http://construction.themerex.net/tag/architecture/" class="tag-cloud-link tag-link-23 tag-link-position-1" style="font-size: 11.733333333333pt;" aria-label="Architecture (5 items)">Architecture</a>
			<a href="http://construction.themerex.net/tag/building/" class="tag-cloud-link tag-link-25 tag-link-position-2" style="font-size: 8pt;" aria-label="Building (4 items)">Building</a>
			<a href="http://construction.themerex.net/tag/change/" class="tag-cloud-link tag-link-27 tag-link-position-3" style="font-size: 11.733333333333pt;" aria-label="Change (5 items)">Change</a>
			<a href="http://construction.themerex.net/tag/construction/" class="tag-cloud-link tag-link-26 tag-link-position-4" style="font-size: 22pt;" aria-label="Construction (9 items)">Construction</a>
			<a href="http://construction.themerex.net/tag/model-prototyping/" class="tag-cloud-link tag-link-28 tag-link-position-5" style="font-size: 17.333333333333pt;" aria-label="Model &amp; Prototyping (7 items)">Model &amp; Prototyping</a>
			<a href="http://construction.themerex.net/tag/remodeling/" class="tag-cloud-link tag-link-22 tag-link-position-6" style="font-size: 8pt;" aria-label="Remodeling (4 items)">Remodeling</a>
			<a href="http://construction.themerex.net/tag/supply-management/" class="tag-cloud-link tag-link-29 tag-link-position-7" style="font-size: 19.666666666667pt;" aria-label="Supply Management (8 items)">Supply Management</a>
    	</div>
	</aside-->
</div>
<!--/SIDEBAR-->

    </div>
    <div class="wpb_column vc_column_container vc_col-sm-9">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="sc_section" style="margin-top:10px !important;background-color:#fff;">
                    <div class="sc_section_overlay" style="">
                        <div class="sc_section_content">
                            <div class="sc_content content_wrap" data-animation="animated fadeInUp normal" style="margin-top:4.5em !important;margin-bottom:3em !important; width:90% !important;">
                                <!--
                                <div class="sc_section aligncenter" style="color:#afb7b9;font-size:13px; line-height: 1.6em;">
                                    <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                            <p>PRODUCTOS</p>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="sc_title sc_title_underline sc_align_center" style="margin-top:5px;margin-bottom:20px;text-align:center;">Destacados</h2>
                                -->
                                <div class="sc_team sc_team_style_2">
                                    <div class="sc_columns columns_wrap">

										<?php one_producto($id)?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--PRODUCTOS-->
	</div>
</div>



