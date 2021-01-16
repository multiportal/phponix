<?php 
if(isset($_SESSION["username"])){
	if($_SESSION["level"]==-1 || $_SESSION["level"]==1){
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $nombre_mod;?>
        <small><?php echo $description_mod;?></small>
      </h1>
	  <?php menu_rutas();?>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="row">
 		<?php //panel_menu();?>
	</div>
    <!-- /.row-->

<div class="row">
<div class="col-xs-12">
<?php
 $re1 = mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."histo_backupdb ORDER BY ID DESC ;") or print mysqli_error($mysqli);
 while($reg1=mysqli_fetch_array($re1)){ 
 $histo1.='<tr><td>'.$reg1['fecha'].'</td><td><a href="'.$page_url.'modulos/sys/backups'.$reg1['archivo'].'" download="Descargar">'.$reg1['archivo'].'</a></td></tr>';
 }

function backup_tables($tables = '*'){
//global $mysqli,$DBprefix,$page_url,$page_name,$title,$dominio,$keyword,$description,$metas,$webMail,$contactMail,$year,$month,$day,$fecha,$date,$mod,$tema,$path_tema,$cont_tema,$ruta_mod,$avi;
//global $ip,$host,$pag_self,$pag_url,$url,$URL,$fiber,$vhref,$database; 
global $mysqli,$DBprefix,$mod,$ext,$vhref,$ip,$host,$page_url,$url,$URL,$year,$month,$day,$fecha,$date,$database;

   if($tables == '*'){
      $tables = array();
      $result = mysqli_query($mysqli,'SHOW TABLES') or print mysqli_error($mysqli);
      while($row = mysqli_fetch_row($result)){
         $tables[] = $row[0];
      }
   }
   else{
      $tables = is_array($tables) ? $tables : explode(',',$tables);
   }

   //cycle through
   foreach($tables as $table){
      $result = mysqli_query($mysqli,'SELECT * FROM '.$table) or print mysqli_error($mysqli);
      $num_fields = mysqli_num_fields($result);
      
      $return.= 'DROP TABLE '.$table.';';
      $row2 = mysqli_fetch_row(mysqli_query($mysqli,'SHOW CREATE TABLE '.$table));
      $return.= "\n\n".$row2[1].";\n\n";
      
    for($i = 0; $i < $num_fields; $i++){
         while($row = mysqli_fetch_row($result)){
            $return.= 'INSERT INTO '.$table.' VALUES(';
            for($j=0; $j<$num_fields; $j++){
               $row[$j] = addslashes($row[$j]);
               $row[$j] = preg_replace("\n","\\n",$row[$j]);
               if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
               if ($j<($num_fields-1)) { $return.= ','; }
            }
            $return.= ");\n";
         }
      }
      $return.="\n\n\n";
   }

############## Fecha y carpeta de salida
 $bak_dir = "modulos/sys/backups";
 $db_name=$database;
 $fecha_hoy = date("Ymd-His");
 $archivo='/db-backup-'.$db_name.'-'.$fecha_hoy.'.sql';
 //save file
 $handle = fopen($bak_dir.$archivo,'w+');
 fwrite($handle,$return);
 fclose($handle);
 
 mysqli_query($mysqli,"INSERT INTO ".$DBprefix."histo_backupdb (fecha,archivo) VALUES ('{$date}','{$archivo}');") or print mysqli_error($mysqli);

 $re = mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."histo_backupdb ORDER BY ID DESC ;") or print mysqli_error($mysqli);
 while($reg=mysqli_fetch_array($re)){ 
 $histo.='<tr><td>'.$reg['fecha'].'</td><td><a href=\"'.$page_url.$bak_dir.$archivo.'\" download>'.$reg['archivo'].'</a></td></tr>';
 }

 echo '
<script>
var cont=0;
var ida=true;
setTimeout("contador()",1000);
function contador(){
var tx="";
	if(cont<=11 && ida==true){
		cont+=1;
	}else{
		//cont-=cont;
		ida=false;
	}
	if(cont>=0){
		tx="Iniciando...<br>";
	}
	if(cont>=2){
		tx+="Comprobando...<br>";
	}
	if(cont>=4){
		tx+="Recopilando Tablas...<br>";
	}
	if(cont>=6){
		tx+="<span style=\"color:#0f0;\">Backup OK</span><br>";
	}
	if(cont>=8){
		tx+="Se hizo el respaldo de las base de datos: '.$db_name.'<br>Fecha: '.$date.'<br>Archivos: '.$page_url.$bak_dir.$archivo.'<br><br>";
	}
	if(cont>=9){
		tx+="<div>Historial</div><table border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr><th><b>Fecha</b></th><th><b>Archivo</b></th></tr>'.$histo.'</table>";
	}
	if(cont>=10){
		ida=false;
	}
	document.getElementById("demo").innerHTML = tx;
	setTimeout("contador()",1000);
}
</script>';
/*Configuraciones de envio*/
/*
ini_set('sendmail_from', 'webmaster@fibremex.com.mx');
ini_set('SMTP','mail.fibremex.com.mx');
ini_set('smtp_port',26);
*/
ini_set('sendmail_from', 'memojl08@gmail.com');
ini_set('SMTP','smtp.gmail.com');
ini_set('smtp_port',25);//465-587
$destinatario="multiportal@outlook.com";
$subject="Backup SITIO ".date("Y-m-d");
############## Mensaje para enviar correo de notificación
 $mensaje = "Se hizo el respaldo de las base de datos: ".$db_name."<br>";
 $mensaje .= "Fecha: ".$date."<br>";
 $mensaje .= "Archivos: ".$page_url.$bak_dir.$archivo;
######## Enviando el correo de notificación
 $headers = "MIME-Version: 1.0\r\n";
 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
 mail($destinatario, $subject, $mensaje,$headers);   

}
?>
<style>#con, #demo{font-size:14px; height:400px;}</style>
<div id="cont-user">

<div id="w7" class="panel panel-primary"> 
	<div class="panel-heading"> 
    	<h3 class="panel-title">DataBase Backup <span style="float:right;"></span></h3> 
    </div> 
    <div class="panel-body">
    	<div id="con">
    		<?php 
			if($_GET['tab']==1){backup_tables();}
			?>
            <div id="demo">
            	<button type="button" class="btn btn-primary" onclick="javascript:document.location.href='<?php echo $page_url.'index.php?mod='.$mod.'&ext='.$ext.'&tab=1';?>';">Iniciar BackupDB</button>
            	<br><br>
				<div>Historial</div><table border="1" cellpadding="1" cellspacing="0"><tr><th><b>Fecha</b></th><th><b>Archivo</b></th></tr><?php echo $histo1;?></table>                
            </div>
        </div>
	</div>
</div>    
</div>


</div>
<!-- /.col-xs-12 -->
</div>
<!-- /.row-->

    </section>
    <!-- /.content -->

<?php 		
	}else{echo '<div id="cont-user">No tiene permiso para ver esta secci&oacute;n.</div>';}
}else{header("Location: ".$page_url."index.php");}
?>