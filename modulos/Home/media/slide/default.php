<div id="banner1">
	<div id="slider-content">
    	<div class="txt-c1"><span style="color:#36C;">Administrar</span> tu negocio</div>
    	<div class="txt-c2">nunca fue tan <span style="color:#36C;">f&aacute;cil</span></div>
        <div class="txt-c3"><b>PhpOnix</b> la soluci&oacute;n completa y moderna, sin complicaciones.</div>
    </div>
</div>
<script>
const ban = document.querySelector('#banner1');
setTimeout(() => {
	if(ban){ //console.log('banner1', ban);
		ban.style.backgroundImage = `url('<?php echo $page_url;?>modulos/Home/img/home.jpg')`;		
	}
}, 800);
</script>