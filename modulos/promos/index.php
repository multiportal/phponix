<?php 
include 'admin/functions.php';
?>
<style>
#promos{width:1120px;margin:5px auto;}
.promos{float:left;width:550px;padding:10px 5px;text-align:center;}
.promos img{width:100%;}
@media screen and (max-width:1120px){
#promos{width:100%;}
}
@media screen and (max-width:550px){
.promos{width:100%;padding:10px 0px;}
}
</style>
         <section class="page-top page-header-1">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="breadcrumbs-wrap">
                        <ul class="breadcrumb">
                           <li class="home" itemscope itemtype="http://schema.org/BreadcrumbList"><a itemprop="url" href="<?php $page_url;?>" title="Go to Home Page"><span itemprop="title">Home</span></a><i class="delimiter"></i></li>
                           <li itemscope itemtype="http://schema.org/BreadcrumbList"><span itemprop="title">Promociones</span></li>
                        </ul>
                     </div>
                     <div class="">
                        <h1 class="page-title">Promos</h1>
                     </div>
                  </div>
               </div>
            </div>
         </section>

<div id="promos">
<?php listar_promos('modulos/'.$mod.'/fotos/');?>
</div>