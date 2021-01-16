<?php 
if(isset($_SESSION["username"])){
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="text-center"><img src="<?php echo $page_url.$path_tema.'images/'.$logo;?>" width="40%"></div>
        <!--div class="pull-left image">
          <img src="<?php echo $page_url.$path_dashboard;?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $username;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div-->
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        <li class="treeview">
          <a href="<?php echo $page_url.'index.php?mod=dashboard';?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <!--span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span-->
          </a>
          <!--ul class="treeview-menu">
            <li><a href="<?php echo $page_url.'index.php?mod='.$dboard;?>"><i class="fa fa-circle-o"></i> Miembros</a></li>
			<?php if($_SESSION["level"]==-1){echo '<li><a href="'.$page_url.'index.php?mod='.$dboard.'"><i class="fa fa-circle-o"></i> Administradores</a></li>';}?>
          </ul-->
        </li>
<?php
	menu_mod('modulos',0);
	menu_mod('menu_admin',0); 
if($nivel_login==-1){
	echo '<li class="header">MENU ADMIN</li>
	  	  <li><a target="_blank" href="'.$page_url.$path_dashboard.'documentation/index.html" alt="Docs (English)"><i class="fa fa-book"></i> <span>Documentaci&oacute;n</span></a></li>';
	menu_mod('modulos',-1);
    menu_mod('menu_admin',-1);
}
?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php 
}
?>