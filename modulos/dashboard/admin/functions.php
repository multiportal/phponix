<?php
//VISITAS
/*
function visitas_hoy(){
global $mysqli,$DBprefix,$year,$month,$day;
$sql=mysqli_query($mysqli,"SELECT DISTINCT ip FROM ".$DBprefix."visitas WHERE fecha>='{$year}-{$month}-{$day} 00:00:00' AND fecha<='{$year}-{$month}-31 23:59:59';") or print mysqli_error($mysqli);
$visitas_hoy=mysqli_num_rows($sql);
echo $visitas_hoy;
}*/

function widget_info_blog2(){
global $mysqli,$DBprefix,$page_url;
$sql=@mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."blog;");
$num_blog=mysqli_num_rows($sql);
echo $num_blog;
}

function widget_info_blog(){
global $mysqli,$DBprefix,$page_url;
$sql=@mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."blog;");
$num_blog=mysqli_num_rows($sql);

 if($sql){
	if($num_blog!=0){
		echo '
		<div class="col-lg-6 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>'.$num_blog.'</h3>
              <p>Entradas Blog</p>
            </div>
            <div class="icon">
              <i class="fa fa-comments"></i>
            </div>
            <a href="'.$page_url.'index.php?mod=blog&ext=admin/index" class="small-box-footer">Ver M&aacute;s <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		';
 	}
 }
}
?>