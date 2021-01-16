<?php
if(isset($_SESSION["username"])){
	if($mode!='intranet'){
		if($_SESSION["level"]==-1){
		$user_type='Administrador';
		$user_access='admin/index';
		}else{
		$user_type='Miembro';
		$user_access='miembros/index';
		}

		echo '
<div id="content1">
    	<div id="intro">

	<div class="panel panel-default">
  		<div class="panel-heading">
    		<h3 class="panel-title">Panel de Administraci&oacute;n
			<span style="float:right;">'.$user_type.' ('.$BLOCK.') | <a href="'.$page_url.'index.php?mod=dashboard">AdminLTE</a></span>
  			</h3>
		</div>
  		<div class="panel-body">
			Gesti&oacute;n de contenido web.
  		</div>
	</div>

<div class="row">
<!--
<div class="col-xs-12 col-md-3" style="padding:0px 6px;">
	<div class="panel panel-default">
  		<div class="panel-body" style="text-align:center;">
    	 	<i class="fa fa-user" style="font-size:140px;"></i>
  		</div>
  		<div class="panel-footer" style="text-align:center;"><a href="#">Perfil</a></div>
	</div>
</div>
<div class="col-xs-12 col-md-3" style="padding:0px 6px;">
	<div class="panel panel-default">
  		<div class="panel-body" style="text-align:center;">
    	 	<i class="fa fa-user" style="font-size:140px;"></i>
  		</div>
  		<div class="panel-footer" style="text-align:center;"><a href="#">Perfil</a></div>
	</div>
</div>
<div class="col-xs-12 col-md-3" style="padding:0px 6px;">
	<div class="panel panel-default">
  		<div class="panel-body" style="text-align:center;">
    	 	<i class="fa fa-user" style="font-size:140px;"></i>
  		</div>
  		<div class="panel-footer" style="text-align:center;"><a href="#">Perfil</a></div>
	</div>
</div>
<div class="col-xs-12 col-md-3" style="padding:0px 6px;">
	<div class="panel panel-default">
  		<div class="panel-body" style="text-align:center;">
    	 	<i class="fa fa-user" style="font-size:140px;"></i>
  		</div>
  		<div class="panel-footer" style="text-align:center;"><a href="#">Perfil</a></div>
	</div>
</div>
-->
</div><!--/*row*/-->

</div></div>
		';
	}else{
	//if($depa==$mod || $_SESSION["level"]==-1){
		if($_SESSION["level"]==-1){
			header('Location: '.$page_url.'index.php?mod=usuarios&ext=admin/index');
		}else {
			header('Location: '.$page_url.'index.php?mod=usuarios&ext=miembros/index');
		}
	}

	//}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>