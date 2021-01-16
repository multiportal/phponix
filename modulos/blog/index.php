<?php include 'admin/functions.php';?>
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
	<?php item_blog();?>
    <div class="col-lg-12 col-xs-12 space"></div>
</div>