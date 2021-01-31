// JavaScript Document
function back(){window.history.go(-1);}
function envio(){document.form1.submit();}
function temas(){document.form_tema.submit();}

function up(val){
	switch (val){
	case 1:
		document.getElementById('upload').innerHTML = '<span style="float:right;"><a href="javascript:up(0);"><i class="fa fa-close" title="Cerrar"></i></a></span><br><input type="file" name="userfile" class="required" size="40" style="font-size: 0.9em;"><br><input type="submit" id="Aceptar" name="Aceptar" value="Aceptar" class="btn btn-primary">';
	break; 
	case 2:
		document.getElementById('upload').innerHTML = '<div style="text-align:right;"><a href="javascript:up(0);"><i class="fa fa-close" title="Cerrar"></i></a></div><div id="box-load2"><input type="file" id="userfile" name="userfile"></div><input type="submit" id="Aceptar" name="Aceptar" value="Aceptar" class="btn btn-primary">';
	break; 
	default: 
		document.getElementById('upload').innerHTML = '';
	break;
	}
}

function upima(val){
	switch (val){
    case 0:
        document.getElementById('upload').innerHTML = '<span style="float:right;"><a href="javascript:upima(-1);"><i class="fa fa-close" title="Cerrar"></i></a></span><br><input type="file" name="userfile" size="40" style="font-size: 0.9em;"><br><input type="submit" name="Aceptar" value="Aceptar" class="btn btn-primary">';
    break; 
    case 1:
        document.getElementById('upload1').innerHTML = '<span style="float:right;"><a href="javascript:upima(-1);"><i class="fa fa-close" title="Cerrar"></i></a></span><br><input type="file" name="userfile'+val+'" size="40" style="font-size: 0.9em;"><br><a href="javascript:imagenes('+val+')" class="btn btn-primary">Aceptar</a>';
    break; 
    case 2:
        document.getElementById('upload2').innerHTML = '<span style="float:right;"><a href="javascript:upima(-1);"><i class="fa fa-close" title="Cerrar"></i></a></span><br><input type="file" name="userfile'+val+'" size="40" style="font-size: 0.9em;"><br><a href="javascript:imagenes('+val+')" class="btn btn-primary">Aceptar</a>';
    break; 
    case 3:
        document.getElementById('upload3').innerHTML = '<span style="float:right;"><a href="javascript:upima(-1);"><i class="fa fa-close" title="Cerrar"></i></a></span><br><input type="file" name="userfile'+val+'" size="40" style="font-size: 0.9em;"><br><a href="javascript:imagenes('+val+')" class="btn btn-primary">Aceptar</a>';
    break; 
    case 4:
        document.getElementById('upload4').innerHTML = '<span style="float:right;"><a href="javascript:upima(-1);"><i class="fa fa-close" title="Cerrar"></i></a></span><br><input type="file" name="userfile'+val+'" size="40" style="font-size: 0.9em;"><br><a href="javascript:imagenes('+val+')" class="btn btn-primary">Aceptar</a>';
    break; 
    case 5:
        document.getElementById('upload5').innerHTML = '<span style="float:right;"><a href="javascript:upima(-1);"><i class="fa fa-close" title="Cerrar"></i></a></span><br><input type="file" name="userfile'+val+'" size="40" style="font-size: 0.9em;"><br><a href="javascript:imagenes('+val+')" class="btn btn-primary">Aceptar</a>';
    break; 
    default: 
		document.getElementById('upload').innerHTML = '';
		document.getElementById('upload1').innerHTML = '';
		document.getElementById('upload2').innerHTML = '';
		document.getElementById('upload3').innerHTML = '';
		document.getElementById('upload4').innerHTML = '';
		document.getElementById('upload5').innerHTML = '';

	}
}

function borrar_ima(val,mod){
    val=(val!=0)?val:'';
    ima=(val==0)?'<img id="img" src="./modulos/'+mod+'/fotos/nodisponible1.jpg" style="width:150px;" title="nodisponible1.jpg">':'';
    document.getElementById('imagen'+val).innerHTML=ima+'<input type="hidden" class="form-control" id="ima'+val+'" name="ima'+val+'" value=""><br><a href="#" onclick="upima('+val+');">Subir Imagen '+val+'</a><div id="upload'+val+'"></div>';
}
