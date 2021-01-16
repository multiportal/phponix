<?php include 'admin/functions.php';?>
<!--<?php tit_seccion();?>-->
	<div class="inner_content_info_agileits">
		<div class="container">
			<h3 class="heading-agileinfo"><?php tit_seccion();?><span><?php des_seccion();?></span></h3>
            <!--div class="row w3ls_banner_bottom_grids"-->
				<?php compact_ajax_mod('items','items',$page_url.'modulos/'.$mod.'/admin/backend.php?mod='.$mod.'&ext='.$ext.'&opc=items',10,0)?>                
            <!--/div-->
		</div>
    </div>
<!--/<?php tit_seccion();?>-->