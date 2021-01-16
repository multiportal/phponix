<?

/************************************

    phpSiteManager
	(c) Yoilier Oro Castelló
	Todos los derechos reservados
Modificado por MULTIPORTAL
Autor: 
	
************************************/

//functions declarate...
function list_dirs($dir)
{
  if(is_dir($dir))
  {
     $dir = add_slash($dir);
	 $directorios[0] = $dir;
	 $cont = glob($dir."*");
	 foreach($cont as $file)
	 {
	    if(is_dir($file))
		{
			$a = list_dirs($file);
			if(count($a) > 0)
			$directorios = @array_merge($directorios,$a);
		}
     }
   }
   return $directorios;
}
function list_dir($dir)
{
  if(is_dir($dir))
  {
     $dir = add_slash($dir);
	 $folder = glob($dir."*");
	 unset($folders);
	 for($i = 0; $i < count($folder); $i++)
	 {
	    if(is_dir($folder[$i]))
		{
			$folders[] = substr($folder[$i],strrpos($folder[$i],"/") + 1);
		}
     }
   }
   return $folders;
}
function list_files($dir)
{
  if(is_dir($dir))
  {
     $dir = add_slash($dir);
	 $files = glob($dir."*");
	 unset($files_arr);
	 for($i = 0; $i < count($files); $i++)
	 {
	    if(is_file($files[$i]))
		{
			$files_arr[] = substr($files[$i],strrpos($files[$i],"/") + 1);
		}
     }
   }
   return $files_arr;
}
function list_dir_files($dir)
{
   if(is_dir($dir))
   {
      $dir = add_slash($dir);
	  $return = "";
      $a = list_dirs($dir);
      for($i = 0; $i < count($a); $i++)
      {
         $return .= "<br><b>".$a[$i]."</b><pre style=\"margin-left:15px;\">";
	     $files = list_files($a[$i]);
		 if(count($files))
	     for($j = 0; $j < count($files); $j++)
	     {
	        $return .= $files[$j]."<br>";
	     }
		 $return .= "</pre>";
      }
   }
   return $return;
}
function copy_dir($dir,$newdir)
{
   if(is_dir($dir) && is_dir($newdir))
   {
	   $dir = add_slash($dir);
	   $url = substr($dir,0,strrpos($dir,"/"));
	   $url = substr($url,strrpos($url,"/")+1);
	   $url = add_slash($url);
	   $newdir = add_slash($newdir);
	   if(!is_dir($newdir.$url)) $newFolder = $newdir.$url;
       elseif(!is_dir($newdir)) $newFolder = $newdir;
       else $newFolder = "";
	   if($newFolder != "") @mkdir($newFolder, 0700);
       $openDir = @opendir($dir);
       while($file = @readdir($openDir))
       {
           if(!in_array($file, array(".", "..")))
           {
              if(!is_dir($dir.$file))
			  @copy($dir.$file,$newdir.$url.$file);
			  else copy_dir($dir.$file,$newdir.$url);
           }
       } 
       @closedir($openDir);
   }
   return is_dir(add_slash($newdir).@basename($dir));
}
function remove_dir($dir)
{
   if(is_dir($dir))
   {
       $dir = add_slash($dir);
       $openDir = @opendir($dir);
       while($file = @readdir($openDir))
       {
           if(!in_array($file, array(".", "..")))
           {
              if(!is_dir($dir.$file))
              @unlink($dir.$file);
              else
              remove_dir($dir.$file);
           }
       } 
       @closedir($openDir);
       @rmdir($dir);
   }
   return !(is_dir($dir));
}
function date_file($file)
{
    $a = @stat($file);
    $size = round($a[7],2);
    $size_u = "B";
	if($size >= 1024)
    {
      $size = round($size / 1024,2);
      $size_u = "KB";
    }
    if($size >= 1024)
    {
      $size = round($size / 1024,2);
      $size_u = "MB";
    }
    if($size >= 1024)
    {
       $size = round($size / 1024,2);
       $size_u = "GB";
    }
    $return[0] = $size;
	$return[1] = $size_u;
    $return[2]  = @date("d/m/Y h:i:s A", @filemtime($file));
	return $return;
}
function extenciones($file)
{
   $arr = array("htm","html","php","js","css","xml","txt","rtf","sql","asp","aspx","cfm","cfc","jsp","dwt","lbi","xsl","as");
   $file = trim(substr($file,strrpos($file,".") + 1));
   $file = strtolower($file);
   return array_search($file,$arr);
}
function add_slash($dir)
{
   $dir = (substr($dir, -1) != "/")? $dir."/":$dir;
   return $dir;
}
function validate_name($name)
{
   $exp_no = array("/","\/","|","<",">","?",":","*","\"");
   $c = 1;
   for($i = 0; $i < count($exp_no); $i++)
   {
      if(strpos($name,$exp_no[$i]) !== false)
	  {
	   	 $c = 0;
	     break;
	  }
   }
   if($c == 1)
   return true;
}
function absolute_url($url)
{
  if($url != "" && is_dir($url))
  $url = @explode("/",$url);
  return @array_search("..",$url);  
}
function change_config()
{
   $string = '<? exit;?>'."\n";
   $string .= '$CONFIG_USERS_ADMIN = array("'.@implode('","',$GLOBALS['CONFIG_USERS_ADMIN']).'");'."\n";
   $string .= '$CONFIG_CLAVE_ADMIN = array("'.@implode('","',$GLOBALS['CONFIG_CLAVE_ADMIN']).'");'."\n";
   $string .= '$CONFIG_PERMISOS_ADMIN = array("'.@implode('","',$GLOBALS['CONFIG_PERMISOS_ADMIN']).'");'."\n";
   $string .= '$CONFIG_TITLE = array("'.@implode('","',$GLOBALS['CONFIG_TITLE']).'");'."\n";
   $string .= '$CONFIG_URL_SITE = array("'.@implode('","',$GLOBALS['CONFIG_URL_SITE']).'");'."\n";
   $string .= '$CONFIG_URL_ADMIN = array("'.@implode('","',$GLOBALS['CONFIG_URL_ADMIN']).'");';
   return @file_put_contents($GLOBALS['CONFIG_FILE'],$string); 
}

session_name('phpSiteManager');
session_start();
$user_id = $_SESSION['phpSiteManager_UserID'];

//default config...
$CONFIG_FILE = "phpsm_config.php";
$adm = $_GET['adm'];
$phpSM = "";
if(is_file($CONFIG_FILE))
{
  $conf = @file($CONFIG_FILE);
  unset($conf[0]);
  @eval(@join("",$conf));
}
if(!is_file($CONFIG_FILE) || !@filesize($CONFIG_FILE) || empty($CONFIG_USERS_ADMIN[0]) || empty($CONFIG_CLAVE_ADMIN[0]))
{
	$phpSM = '<form action="" method="post" name="form1" id="form1">
                <table border="0" class="formul" cellspacing="0">
				  <tr class="titulo_dialogo"><td>&nbsp;&nbsp;Configurar phpSiteManager</td></tr>
				  <tr><td>
				   <table cellpadding="3">
				    <tr>
                     <td colspan="2">
					 &iexcl;Bienvenido! Para instalar phpSiteManager
					 establezca un nombre usuario y contrase&ntilde;a de Administraci&oacute;n.
					 </td>
                    </tr>
					<tr>
                     <td>Administrador:</td>
                     <td align="left">
					   <input name="config_user_admin" type="text" size="30" value="'.$_POST['config_user_admin'].'">
					 </td>
                    </tr>
					<tr>
                     <td>Contrase&ntilde;a:</td>
                     <td align="left"><input name="config_clave_admin" type="password" size="30"></td>
                    </tr>
					<tr>
                     <td>Repetir Contrase&ntilde;a:</td>
                     <td align="left"><input name="config_clave_admin_verifi" type="password" size="30"></td>
                    </tr>
                    <tr>
	                 <td>&nbsp;</td>
                     <td align="left">
					  <input type="submit" value="Guardar configuraci&oacute;n" />
					  <input name="valor" type="hidden" id="valor" value="1" />
					 </td>
                    </tr>
					</table>
				   </td></tr>
				  </table>
				 </form>';
	if($_POST['valor'] == 1)
	{
	   if($_POST['config_user_admin'] == "")
	   $phpSM = '<font color="red">ERROR! Establezca un nombre de usuario para el Administrador.</font><br><br>'.$phpSM;
	   elseif($_POST['config_clave_admin'] == "" || $_POST['config_clave_admin'] != $_POST['config_clave_admin_verifi'])
	   $phpSM = '<font color="red">ERROR! La contrase&ntilde;a no coincide en los dos campos.</font><br><br>'.$phpSM;
	   else
	   {
		   $CONFIG_USERS_ADMIN[0] = $_POST['config_user_admin'];
		   $CONFIG_CLAVE_ADMIN[0] = md5($_POST['config_clave_admin']);
		   $CONFIG_PERMISOS_ADMIN[0] = "*";
		   $CONFIG_TITLE[0] = "phpSiteManager";
           $CONFIG_URL_SITE[0] = dirname($_SERVER['HTTP_REFERER']);
           $CONFIG_URL_ADMIN[0] = "";
		   if(change_config())
		   {
		      header("Location: ".$_SERVER['PHP_SELF']);
		      exit;
		   }else
		   {
			   $phpSM = '<font color="red">ERROR! No se pudo crear el archivo '.$CONFIG_FILE.'.</font><br><br>'.$phpSM;
		   }
	   }
	   
	}
}else
{
$permisos = array("*","newF","copyF","renameF","deleteF","upload","download","edit","copyA","renameA","deleteA","conf","changePW");
$CONFIG_URL_ADMIN = @explode(",",$CONFIG_URL_ADMIN[$user_id]);
$url_this_file = add_slash(dirname($_SERVER['SCRIPT_FILENAME']));
$CONFIG_URL_ADMIN = $url_this_file.@implode("",$CONFIG_URL_ADMIN);
if(!is_dir($CONFIG_URL_ADMIN))
{
   $adm = "config";
}
$CONFIG_URL_ADMIN = add_slash($CONFIG_URL_ADMIN);
//permisos administrator...
if($_SESSION['phpSiteManager'] == md5($CONFIG_CLAVE_ADMIN[$user_id]))
{
$this_permisos = $CONFIG_PERMISOS_ADMIN[$user_id];
$this_permisos = @explode(",",$this_permisos);
if($_REQUEST['cancelar']) unset($_POST['valida_action']);
$validation = '<div style="margin-left:20px;">
                  <br><b><font color="red">AVISO ! !<br>
				  Realizar cambios pueden afectar el correcto funcionamiento del sitio.</font></b><br><br>
                  <input type="checkbox" name="valida_action" id="valida_action" value="1">
				  <label for="valida_action"><b>Acepto las consecuencias</b></label><br>
				  <label for="valida_action"><i>Nota:</i> Debe marcar esta casilla para realizar la acci&oacute;n.</label><br><br>
			      <input type="submit" name="aceptar" value="Aceptar" />
		          <input type="submit" name="cancelar" value="Cancelar" />
			    </div>';
/*variables...*/
if(isset($_POST['carpeta']))
$carpeta = $_POST['carpeta'];
elseif(isset($_GET['carpeta']))
$carpeta = $_GET['carpeta'];
if(empty($_SESSION['phpSM_Folder']))
$_SESSION['phpSM_Folder'] = $CONFIG_URL_ADMIN;
if($carpeta >= 1){
   $carpetas = list_dir($_SESSION['phpSM_Folder']);
   $carpetas = $carpetas[$carpeta-1];
   $_SESSION['phpSM_Folder'] = $_SESSION['phpSM_Folder'].$carpetas;
}elseif($carpeta < 0){
   $c = abs($carpeta);
   for($i = 1; $i <= $c; $i++){
      $_SESSION['phpSM_Folder'] = substr($_SESSION['phpSM_Folder'],0,strrpos($_SESSION['phpSM_Folder'],"/"));
      $_SESSION['phpSM_Folder'] = substr($_SESSION['phpSM_Folder'],0,strrpos($_SESSION['phpSM_Folder'],"/")+1);
   }
}
if(!is_dir($_SESSION['phpSM_Folder']) || strlen($_SESSION['phpSM_Folder']) < strlen($CONFIG_URL_ADMIN))
$_SESSION['phpSM_Folder'] = $CONFIG_URL_ADMIN;
$_SESSION['phpSM_Folder'] = add_slash($_SESSION['phpSM_Folder']);
$carpeta = $_SESSION['phpSM_Folder'];
$valor = $_POST['valor'];
$total = $_POST['total'];
/**end variables...*/
if($adm == "config")
{
    $url_adm = add_slash(dirname($_SERVER['HTTP_REFERER']));
	$CONFIG_URL_ADMIN[$user_id] = "";
	@eval(@join("",$conf));
	$permisos_s = array("Administrador (Todos los permisos)",
                        "Crear carpetas","Copiar carpetas","Renombrar carpetas","Eliminar carpetas",
					    "Subir archivos","Descargar archivos","Editar archivos","Copiar archivos","Renombrar archivos",
					    "Eliminar archivos","Configurar","Cambiar contrase&ntilde;a");
	$mod = $_GET['mod'];
	if($mod == "add_user" && $this_permisos[0] == "*")
	{
	   $phpSM = '<fieldset><legend>Agregar usuario</legend>
				   <form action="" method="post" name="form2" id="form2">
				   <table cellpadding="3">
				    <tr>
                     <td>Nombre de usuario:</td>
                     <td align="left"><input name="new_user" type="text" value="'.$_POST['new_user'].'"size="30"></td>
                    </tr>
					<tr>
                     <td>Contrase&ntilde;a:</td>
                     <td align="left"><input name="new_pass" type="password" size="30"></td>
                    </tr>
					<tr>
                     <td>Repetir Contrase&ntilde;a:</td>
                     <td align="left"><input name="new_pass_r" type="password" size="30"></td>
                    </tr>
					<tr>
                     <td>Administrador:</td>
                     <td align="left">
					   <input name="uis_admin" type="radio" value="*">Si
					   <input name="uis_admin" type="radio" value="" checked="checked">No
					 </td>
                    </tr>
                    <tr>
	                 <td>&nbsp;</td>
                     <td align="left">
					  <input type="submit" value="Crear usuario" />
					  <input name="valor" type="hidden" id="valor" value="1" />
					 </td>
                    </tr>
					</table>
					</form>
			     </fieldset>';
		if($valor == 1)
	    {
	       if($_POST['new_user'] == "")
		   $phpSM = '<font color="red">ERROR! Escriba un nombre de usuario.</font><br><br>'.$phpSM;
		   elseif(@array_search($_POST['new_user'],$CONFIG_USERS_ADMIN) !== false)
		   $phpSM = '<font color="red">ERROR! Ese nombre de usuario ya est&aacute; en uso.</font><br><br>'.$phpSM;
		   elseif($_POST['new_pass'] == "" || $_POST['new_pass'] != $_POST['new_pass_r'])
	       $phpSM = '<font color="red">ERROR! La contrase&ntilde;a no coincide en los dos campos.</font><br><br>'.$phpSM;
	       else
	       {
	           $a = count($CONFIG_USERS_ADMIN);
			   $CONFIG_USERS_ADMIN[$a] = $_POST['new_user'];
			   $CONFIG_CLAVE_ADMIN[$a] = md5($_POST['new_pass']);
			   $CONFIG_PERMISOS_ADMIN[$a] = $_POST['uis_admin'];
		       if(change_config())
			   {
		           header("Location: ".$_SERVER['PHP_SELF']."?adm=$adm&mod=add_user");
		           exit;
			   }else
			   {
			       $phpSM = '<font color="red">ERROR! No se pudo completar la acci&oacute;n.</font><br><br>'.$phpSM;
			   }
	      }
       }
	}elseif($mod == "change_pass")
	{
	   if($this_permisos[0] == "*" || @array_search("changePW",$this_permisos) !== false)
	   $phpSM = '<fieldset><legend>Cambiar contrase&ntilde;a</legend>
				   <form action="" method="post" name="form2" id="form2">
				   <table cellpadding="3">
				    <tr>
                     <td>Contrase&ntilde;a actual:</td>
                     <td align="left"><input name="config_clave_admin_actual" type="password" size="30"></td>
                    </tr>
					<tr>
                     <td>Nueva Contrase&ntilde;a:</td>
                     <td align="left"><input name="config_clave_admin" type="password" size="30"></td>
                    </tr>
					<tr>
                     <td>Repetir Contrase&ntilde;a:</td>
                     <td align="left"><input name="config_clave_admin_verifi" type="password" size="30"></td>
                    </tr>
                    <tr>
	                 <td>&nbsp;</td>
                     <td align="left">
					  <input type="submit" value="Cambiar contrase&ntilde;a" />
					  <input name="valor" type="hidden" id="valor" value="1" />
					 </td>
                    </tr>
					</table>
					</form>
					</fieldset>';
		if($valor == 1)
	    {
	        if(md5($_POST['config_clave_admin_actual']) != $CONFIG_CLAVE_ADMIN[$user_id])
		    $phpSM = '<font color="red">ERROR! Repita la contrase&ntilde;a actual.</font><br><br>'.$phpSM;
		    elseif($_POST['config_clave_admin'] == "" || $_POST['config_clave_admin'] != $_POST['config_clave_admin_verifi'])
	        $phpSM = '<font color="red">ERROR! La contrase&ntilde;a no coincide en los dos campos.</font><br><br>'.$phpSM;
	        else
	        {
	            $CONFIG_CLAVE_ADMIN[$user_id] = md5($_POST['config_clave_admin']);
		        if(change_config())
			    {
		            header("Location: ".$_SERVER['PHP_SELF']);
		            exit;
			    }else
			    {
			       $phpSM = '<font color="red">ERROR! No se pudo completar la acci&oacute;n.</font><br><br>'.$phpSM;
			    }
	        }
	   
	    }
	}elseif($mod == "update_user" && $this_permisos[0] == "*")
	{
	   $user_e = $_POST['list_users'];
	   if($valor == 5)
	   {
	      $user_e = $_POST['edit_user'];
		  $permis_update = array();
		  $permis_update = @array_merge($_POST['per_user'],$permis_update);
		  if($permis_update[0] == "*")
		  $permis_update = array("*");
		  $permis_update = @implode(",",$permis_update);
		  $CONFIG_PERMISOS_ADMIN[$user_e] = $permis_update;
		  $CONFIG_TITLE[$user_e] = $_POST['title'];
		  $CONFIG_TITLE[$user_e] = $_POST['title'];
          $CONFIG_URL_SITE[$user_e] = $_POST['url_site'];
		  $CONFIG_URL_ADMIN[$user_e] = add_slash($_POST['url_admin']);
		  if(!is_dir($CONFIG_URL_ADMIN[$user_e])){
		     $phpSM = '<font color="red">ERROR! Suministre un directorio v&aacute;lido.</font><br><br>';
			 $valor = 4;
		  }else{
		    if(change_config())
		    {
			   header("Location: ".$_SERVER['PHP_SELF']."?adm=$adm&mod=$mod");
		       exit;
		    }else
		    {
			   $phpSM = '<font color="red">ERROR! No se pudo completar la acci&oacute;n.</font><br><br>';
		    }
		  }
	   }elseif($valor == 6)
	   {
	      if(!isset($_POST['cancel']))
		  {
		     $user_e = $_POST['edit_user'];
			 unset($CONFIG_USERS_ADMIN[$user_e],$CONFIG_CLAVE_ADMIN[$user_e],$CONFIG_PERMISOS_ADMIN[$user_e]);
			 unset($CONFIG_TITLE[$user_e],$CONFIG_URL_SITE[$user_e],$CONFIG_URL_ADMIN[$user_e]);
			 if($user_e != $user_id)
			 if(change_config())
		     {
			    header("Location: ".$_SERVER['PHP_SELF']."?adm=$adm&mod=$mod");
		        exit;
		     }else
		     {
			    $phpSM = '<font color="red">ERROR! No se pudo completar la acci&oacute;n.</font><br><br>';
				$config_error = 1;
		     }
		  }
		   if(!$config_error){
		       header("Location: ".$_SERVER['PHP_SELF']."?adm=$adm&mod=$mod");
		       exit;
		     }
	   }elseif($valor == 7)
	   {
	      $user_e = $_POST['edit_user'];
		  if($_POST['config_clave_admin'] == "" || $_POST['config_clave_admin'] != $_POST['config_clave_admin_verifi'])
		  {
			 $phpSM = '<font color="red">ERROR! La contrase&ntilde;a no coincide en los dos campos.</font><br><br>';
			 $config_error = 1;
			 $valor = 4;
		  }else{
		    $CONFIG_CLAVE_ADMIN[$user_e] = md5($_POST['config_clave_admin']);
		    if(change_config())
		    {
		        header("Location: ".$_SERVER['PHP_SELF']."?adm=$adm&mod=$mod");
		        exit;
		    }else
		    {
			    $phpSM = '<font color="red">ERROR! No se pudo completar la acci&oacute;n.</font><br><br>';
			    $config_error = 1;
		    }
		   }
		   if(!$config_error){
		       header("Location: ".$_SERVER['PHP_SELF']."?adm=$adm&mod=$mod");
		       exit;
		     }
	   }
	   $total = count($CONFIG_USERS_ADMIN);
	   $usuarios = '<select name="list_users">';
	   for($i = 0; $i < $total; $i++)
	   {
	      if($user_e == $i)
		  $selected = " selected=\"selected\"";
		  else $selected = "";
		  $usuarios .= "<option value=\"$i\"$selected>$CONFIG_USERS_ADMIN[$i]</option>";
	   }
	   $usuarios .= "</select>";
	   $phpSM .= '<fieldset><legend>Actualizar usuarios</legend>
				   <form action="" method="post" name="form2" id="form2">
				   <table cellpadding="3">
				    <tr>
                     <td align="right">Lista de usuarios:</td>
                     <td align="left">'.$usuarios.'</td>
                    </tr>
                    <tr>
                     <td colspan="2" align="center">
					  <input type="submit" value="Editar usuario" />
					  <input type="submit" value="Eliminar usuario" name="delete_user" />
					  <input name="valor" type="hidden" id="valor" value="4" />
					 </td>
                    </tr>
					</table>
					</form>
					</fieldset>';
	   if($valor == 4)
	   {
	      if(isset($_POST['delete_user']))
		  {
		     if($user_e == $user_id)
			 {
			    $phpSM = '<font color="red">ERROR! No puede eliminarse usted mismo.</font><br><br>'.$phpSM;
			 }else
			 $phpSM = '<fieldset><legend>Eliminar usuarios</legend>
				   <form action="" method="post" name="form2" id="form2">
				   <table cellpadding="3">
				    <tr>
                     <td align="right">&iquest;Desea eliminar el usuario '.$CONFIG_USERS_ADMIN[$user_e].'?</td>
                    </tr>
                    <tr>
                     <td>
					  <input name="valor" type="hidden" id="valor" value="6" />
					  <input name="edit_user" type="hidden" id="edit_user" value="'.$user_e.'" />
					   <input type="submit" value="Eliminar usuario" />
					   <input type="submit" value="Cancelar" name="cancel" />
					 </td>
                    </tr>
					</table>
					</form>
					</fieldset>';
		  }else{
		  $perm = $CONFIG_PERMISOS_ADMIN[$user_e];
		  $perm = @explode(",",$perm);
          $table = "<form method=\"post\">\n<table>\n";
		  if($user_e == $user_id)
		  {
		     $table .= "<tr>\n";
			 $table .= "<td colspan=\"3\">";
			 $table .= "<input type=\"checkbox\" value=\"*\" disabled=\"disabled\" checked=\"checked\">";
			 $table .= "<input type=\"hidden\" name=\"per_user[0]\" value=\"*\">";
			 $table .= "<label>".$permisos_s[0]."</label></td>\n";
			 $table .= "</tr>\n";
			 
		  }else{
		    $c = 1;
			$count_permisos = count($permisos);
            for($i = 0; $i < $count_permisos; $i++)
            {
               if($c == 1)
               $table .= "<tr>\n";
               if(@array_search($permisos[$i],$perm) !== false)
               $checked = " checked=\"checked\"";
               else $checked = "";
               $table .= "<td><input type=\"checkbox\" id=\"per$i\"name=\"per_user[$i]\" value=\"$permisos[$i]\"$checked>";
			   $table .= "<label for=\"per$i\">".$permisos_s[$i]."</label></td>\n";
               if($c == 3 || $i + 1 == $count_permisos)
               {
                  $table .= "</tr>\n";
	              $c = 0;
               } 
               $c ++;
            }
		  }
		  $table .= "<tr><td colspan=\"3\">";
		  $urls = @explode(",",$CONFIG_URL_ADMIN[$user_e]);
		  $table .= '<table cellpadding="3">
				    <tr>
                     <td>T&iacute;tulo del sitio:</td>
                     <td><input name="title" type="text" value="'.$CONFIG_TITLE[$user_e].'" size="50"></td>
                    </tr>
					<tr>
                     <td>URL del sitio en el servidor:</td>
                     <td><input name="url_site" type="text" value="'.$CONFIG_URL_SITE[$user_e].'" size="50"></td>
                    </tr>
					<tr>
                     <td>URL a administrar con phpSiteManager:</td>
                     <td>'.$url_adm.'<input name="url_admin" type="text" value="'.$urls[0].'" size="50"></td>
                    </tr>
					</table></td></tr>';
          $table .= "<tr>\n";
		  $table .= "<td colspan=\"3\"><input name=\"valor\" type=\"hidden\" id=\"valor\" value=\"5\" />";
		  $table .= "<input name=\"edit_user\" type=\"hidden\" id=\"edit_user\" value=\"$user_e\" />";
		  $table .= "<input type=\"submit\" name=\"bto\" value=\"Guardar cambios\"></td>\n";
          $table .= "</tr>\n";
          $table .= "</table>\n</form>";
		  if($user_e != $user_id)
		  $table .= '<br><fieldset><legend>Cambiar contrase&ntilde;a</legend>
				   <form action="" method="post" name="form2" id="form2">
				   <table cellpadding="3">
					<tr>
                     <td>Nueva Contrase&ntilde;a:</td>
                     <td align="left"><input name="config_clave_admin" type="password" size="30"></td>
                    </tr>
					<tr>
                     <td>Repetir Contrase&ntilde;a:</td>
                     <td align="left"><input name="config_clave_admin_verifi" type="password" size="30"></td>
                    </tr>
                    <tr>
	                 <td>&nbsp;</td>
                     <td align="left">
					  <input type="submit" value="Cambiar contrase&ntilde;a" />
					  <input name="edit_user" type="hidden" id="edit_user" value="'.$user_e.'" />
					  <input name="valor" type="hidden" id="valor" value="7" />
					 </td>
                    </tr>
					</table>
					</form>
					</fieldset>';
          $phpSM .= $table; 
		  }
	   }
	}
	if(empty($phpSM)){
	   if($this_permisos[0] != "*")
	   {
	      $urls = @explode(",",$CONFIG_URL_ADMIN[$user_id]);
		  $url_adm .= $urls[0];
		  $url_adm_conf = $urls[1];
	   }else $url_adm_conf = $CONFIG_URL_ADMIN[$user_id];
	   $url_adm = add_slash($url_adm);
	   if($valor == "default")
	   {
		   $config_error = 0;
		   $CONFIG_TITLE[$user_id] = $_POST['config_title_sitio'];
	       $CONFIG_URL_SITE[$user_id] = $_POST['config_url_sitio'];
	       $url_adm_conf = trim($_POST['config_url_admin_sitio']);
		   if($this_permisos[0] == "*")
		   {
		      $CONFIG_URL_ADMIN[$user_id] = array();
			  $CONFIG_URL_ADMIN[$user_id][0] = $url_adm_conf;
			  $url_adm_conf_pp = $url_adm_conf;
		   }else{
			  unset($CONFIG_URL_ADMIN[$user_id]);
			  if($urls[0] != "")
		      $CONFIG_URL_ADMIN[$user_id][0] = add_slash(trim($urls[0]));
			  if($url_adm_conf != ""){
			     $CONFIG_URL_ADMIN[$user_id][1] = add_slash($url_adm_conf);
				 $url_adm_conf_pp = $url_adm_conf;
			  }
			  $url_adm_conf = @implode("",$CONFIG_URL_ADMIN[$user_id]);
		   }
		   if($url_adm_conf != "")
		   if(!is_dir($url_this_file.$url_adm_conf) || substr($url_adm_conf_pp,0,1) == "/")
		   {
		      $phpSM = '<font color="red">ERROR! Suministre un directorio v&aacute;lido.</font><br><br>'.$phpSM;
			  $config_error = 1;
		   }
		   if(@array_search("conf",$this_permisos) !== false && $this_permisos[0] != "*")
		   if(absolute_url($url_adm_conf_pp) !== false)
		   {
		      $phpSM = '<font color="red">ERROR! Suministre un directorio v&aacute;lido.</font><br><br>'.$phpSM;
			  $config_error = 1;
		   }
		   if(!$config_error){
		      $CONFIG_URL_ADMIN[$user_id] = @implode(",",$CONFIG_URL_ADMIN[$user_id]);
		      if(change_config())
		      {
			     unset($_SESSION['phpSM_Folder']);
			  }else
		      {
			     $phpSM = '<font color="red">ERROR! No se pudo completar la acci&oacute;n.</font><br><br>'.$phpSM;
			     $config_error = 1;
		      }
		   }
		   if(!$config_error){
		       header("Location: ".$_SERVER['PHP_SELF']);
		       exit;
		   }
		   
	    }else
	    {
	       $_POST['config_title_sitio'] = $CONFIG_TITLE[$user_id];
	       $_POST['config_url_sitio'] = $CONFIG_URL_SITE[$user_id];
	       $_POST['config_url_admin_sitio'] = $url_adm_conf;
	    }
	    if($this_permisos[0] == "*" || @array_search("conf",$this_permisos) !== false)
	    $phpSM .= '<fieldset><legend>Configuraci&oacute;n</legend>
				   <form action="" method="post" name="form1" id="form1">
				   <table cellpadding="3">
				    <tr>
                     <td>T&iacute;tulo del sitio:</td>
                     <td><input name="config_title_sitio" type="text" value="'.$_POST['config_title_sitio'].'" size="50"></td>
                    </tr>
					<tr>
                     <td>URL del sitio en el servidor:</td>
                     <td><input name="config_url_sitio" type="text" value="'.$_POST['config_url_sitio'].'" size="50"></td>
                    </tr>
					<tr>
                     <td>URL a administrar con phpSiteManager:</td>
      <td>'.$url_adm.'<input name="config_url_admin_sitio" type="text" value="'.$_POST['config_url_admin_sitio'].'" size="50"></td>
                    </tr>
                    <tr>
	                 <td>&nbsp;</td>
                     <td>
					   <input name="valor" type="hidden" id="valor" value="default" />
					   <input type="submit" value="Guardar configuraci&oacute;n" />
                      </td>
                     </tr>
					</table>
					</form>
					</fieldset>';
	  }
	  unset($menu);
	  if($this_permisos[0] == "*")
	  {
	     $menu[] = "<a href=\"?adm=$adm\">Configuraci&oacute;n</a>";
		 if(count($CONFIG_USERS_ADMIN) > 1)
		 $menu[] = "<a href=\"?adm=$adm&mod=update_user\">Administrar usuarios</a>";
		 $menu[] = "<a href=\"?adm=$adm&mod=add_user\">Agregar usuarios</a>";
		 $menu[] = "<a href=\"?adm=$adm&mod=change_pass\">Cambiar contrase&ntilde;a</a>";
	  }else{
	  
	     if(@array_search("conf",$this_permisos) !== false)
		 $menu[] = "<a href=\"?adm=$adm\">Configuraci&oacute;n</a>";
		 if(@array_search("changePW",$this_permisos) !== false)
		 $menu[] = "<a href=\"?adm=$adm&mod=change_pass\">Cambiar contrase&ntilde;a</a>";
	  }
	  $menu = @implode(" | ",$menu)."<br><br>";
	  $phpSM = '<table cellspacing="0" class="formul">
				  <tr class="titulo_dialogo"><td>&nbsp;&nbsp;Configurar phpSiteManager</td></tr>
				  <tr><td valign="top">
				     <table cellpadding="3" width="100%">
				      <tr>
                        <td>'.$menu.$phpSM.'</td>
					  </tr>
					 </table>
				   </td></tr>
			    </table>';
}elseif($adm == "out")
{
   $_SESSION = array();
   @session_destroy();
   header("Location: ".$_SERVER['PHP_SELF']);
   exit;
}elseif($adm == "newfolder" && ($this_permisos[0] == "*" || @array_search("newF",$this_permisos) !== false))
{
    $add_folder = '<form action="" method="post" name="form1" id="form1">
                  <table cellspacing="0" class="formul">
				    <tr class="titulo_dialogo"><td>&nbsp;&nbsp;Crear carpetas</td></tr>
					<tr><td>
					   <table cellpadding="3">
						 <tr>
						   <td>Nombre:</td>
						   <td><input type="text" name="nombre" value="'.$_POST['nombre'].'" maxlength="50" size="50" /></td>
						 </tr>
						 <tr>
						   <td>&nbsp;</td>
						   <td>
						     <input name="valor" type="hidden" id="valor" value="1" />
						     <input type="submit" name="newFoldr" value="Crear" />
						     <input type="submit" name="cancel" value="Cancelar" />
						   </td>
						 </tr>
					   </table>
					  </td></tr>
					 </table>
					</form><br><br>';
   if($valor == 1)
   {
      if($_REQUEST['cancel'])
	  {
	      header("Location: ".$_SERVER['PHP_SELF']);
	      exit;
	  }elseif($_POST['nombre'] != "")
	  {
		  $name = $carpeta.$_POST['nombre'];
		  if(validate_name($_POST['nombre']))
	      {  
             if(!is_dir($name))
			 {
			    if(@mkdir($name, 0700))
			    {
			       header("Location: ".$_SERVER['PHP_SELF']);
	               exit;
			    }else{
			           $add_folder = "<font color=\"red\">ERROR! No se puede crear la carpeta.</font><br><br>".$add_folder;
			         }
			 }else $add_folder = "<font color=\"red\">ERROR! Ya existe un directorio con ese nombre.</font><br><br>".$add_folder;
          }else{
			      $add_folder = "<font color=\"red\">ERROR! Nombre no v&aacute;lido.</font><br><br>".$add_folder;
			   }
	  }
   }
}elseif($adm == "upload" && ($this_permisos[0] == "*" || @array_search("upload",$this_permisos) !== false))
{
    $upload = '<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
               <table cellspacing="0" class="formul">
			     <tr class="titulo_dialogo"><td>&nbsp;&nbsp;Subir archivos</td></tr>
				 <tr><td>
				   <table cellpadding="3">
					 <tr>
					   <td>Archivo a Subir:</td>
					   <td><input type="file" name="upload_file" size="80"/></td>
					 </tr>
					 <tr>
					   <td>&nbsp;</td>
					   <td>
					     <input name="valor" type="hidden" id="valor" value="1" />
					     <input type="submit" name="Submit" value="Subir Archivo" />
						 <input type="submit" name="cancel" value="Cancelar" />
					   </td>
					 </tr>
				   </table>
				 </td></tr>
			    </table>
			 </form><br><br>';
   if($valor == 1)
   {
      if($_REQUEST['cancel'])
	  {
	      header("Location: ".$_SERVER['PHP_SELF']);
	      exit;
	  }if(isset($_FILES['upload_file']) && $_FILES['upload_file']['name'] != "")
      { 
	     $destino = $carpeta.$_FILES['upload_file']['name'];
         if(!@move_uploaded_file($_FILES['upload_file']['tmp_name'], $destino)) 
	     { 
            $upload = "<font color=\"red\">ERROR! No se pudo subir el archivo.</font><br><br>".$upload;
         }
		 
      }
   }
}

if(isset($_REQUEST['copy_files']) || isset($_REQUEST['copy_folder']) 
|| isset($_REQUEST['paste_files']) || isset($_REQUEST['paste_folder']))
$mod = "copy";
elseif(isset($_REQUEST['rename_files']) || isset($_REQUEST['rename_folder']))
$mod = "rename";
elseif(isset($_REQUEST['delete_files']) || isset($_REQUEST['delete_folder']))
$mod = "delete";
elseif($_GET['mod'] == "edition")
$mod = "edition";
elseif($_GET['mod'] == "download")
$mod = "download";
else
$mod = $_POST['mod'];
if($mod == "copy")
{
  if($valor == 1)
  {
	 if(isset($_REQUEST['copy_files']) && $total > 0)
     {   
		$_SESSION['phpSM_Copy'][0] = $carpeta;
		unset($_SESSION['phpSM_Copy'][1]);
        for($c = 0; $c <= $total; $c++)
        {
           if(isset($_POST['files'.$c]))
	       {
			  $_SESSION['phpSM_Copy'][1][] = $_POST['files'.$c];
	       }
        }
    }elseif(isset($_REQUEST['copy_folder']))
    {
       $_SESSION['phpSM_Copy'][0] = $carpeta;
	   unset($_SESSION['phpSM_Copy'][1]);
    }elseif(isset($_REQUEST['paste_files']))
	{
        $files = "";
		$arr = $_SESSION['phpSM_Copy'][1];
        for($c = 0; $c < count($arr); $c++)
        {
           if(isset($arr[$c]))
	       {
		      $files .= "<br>".$arr[$c];
	          $files .= '<input name="files'.$c.'" type="hidden" id="files'.$c.'" value="'.$arr[$c].'" />';
	       }
         }
         if($c > 0)
         {
            if($c == 1)
            $files = 'Confirma que desea copiar el archivo: <b>'.$files.'</b>';
            else $files = 'Confirma que desea copiar los siguientes archivos: <b>'.$files.'</b>';
			$files .= "<br><br>Origen: <b>".$_SESSION['phpSM_Copy'][0].'</b><br> Destino: <b>'.$carpeta.'</b>';
            $phpSM = '<form action="" method="post" name="form1" id="form1">
                       <table border="0" class="formul" cellspacing="0">
			             <tr class="titulo_dialogo"><td colspan="2">&nbsp;&nbsp;Copiar archivos</td></tr>
			               <tr><td colspan="2">
				             <table cellpadding="3">
					           <tr><td colspan="2">'.$files.'</td></tr>
						       <tr><td colspan="2">
						        '.$validation.'
							     <input name="valor" type="hidden" id="valor" value="2" />
							     <input name="mod" type="hidden" id="mod" value="copy" />
								 <input name="carpeta_destino" type="hidden" id="carpeta_destino" value="'.$carpeta.'" />								
                               </td></tr>
				             </table>
				           </td></tr>
                         </table></form>';
       }
	}elseif(isset($_REQUEST['paste_folder']))
	{
	    $phpSM = '<form name="form1" method="post" action="">
		           <table border="0" class="formul" cellspacing="0">
                     <tr><td class="titulo_dialogo">&nbsp;&nbsp;Copiar carpetas</td></tr>
  					  <tr><td><table cellpadding="3">
           	            <tr><td>
				              Confirma que desea copiar el directorio:<br>Origen: <b>'.$_SESSION['phpSM_Copy'][0].'</b><br>
						      Destino: <b>'.$carpeta.'</b>
					    </td></tr>
				          <tr>
						     <td>
							   <input name="valor" type="hidden" id="valor" value="3" />
							   <input name="mod" type="hidden" id="mod" value="copy" />
							   <input name="carpeta_destino" type="hidden" id="carpeta_destino" value="'.$carpeta.'" />
							   '.$validation.'
							  </td>
				           </tr>
						   </table></td></tr>
				         </table></form>';
	}
   }elseif($valor == 2)
   {
	  $origen = $_SESSION['phpSM_Copy'][0];
	  $destino = $_POST['carpeta_destino'];
	  $arr = $_SESSION['phpSM_Copy'][1];
	  if($origen != $carpeta)
      if($_POST['valida_action'])
	  {
		 for($c = 0; $c < count($arr); $c++)
	     {
	        if(isset($arr[$c]))
		    {
		        $fil = $arr[$c];
		        if(!@copy($origen.$fil,$destino.$fil))
				{
				   $error_copy = 1;
				   $phpSM .= "<font color=\"red\">No se pudo copiar el archivo <b>$fil</b>.
				              Revise los permisos de la carpeta <b>".@basename($destino)."</b>.</font><br><br>";
				}
		    }
	     }
		 $_SESSION['phpSM_Folder'] = $destino;
		 if($error_copy != 1){
		    unset($_SESSION['phpSM_Copy']);
		    header("Location: ".$_SERVER['PHP_SELF']);
		    exit;
		 }
	   }
	}elseif($valor == 3)
	{
		if($_POST['valida_action'])
		{
	       $destino = $_POST['carpeta_destino'];
		   $_SESSION['phpSM_Folder'] = $destino;
		   if(!copy_dir($_SESSION['phpSM_Copy'][0],$destino))
		   {
		        $phpSM .= "<font color=\"red\">No se pudo copiar el directorio.
				            Revise los permisos de la carpeta <b>".@basename($destino)."</b>.</font><br><br>";
		   }else{
		      unset($_SESSION['phpSM_Copy']);
		      header("Location: ".$_SERVER['PHP_SELF']);
		      exit;
		   }
	    }
	}
}elseif($mod == "rename")
{
   if($valor == 1)
   {
       if(isset($_REQUEST['rename_files']))
       {
          for($i = 0; $i <= $total; $i++)
          {
             if(isset($_POST['files'.$i]))
             {
               $filesa[] = $_POST['files'.$i];
             }
          }
	      $type = 1;
       }elseif(isset($_REQUEST['rename_folder']))
       {
           $filesa[0] = basename($carpeta);
	       $type = 2;
       }
       if($filesa)
       {
          $renames_files = "";
          for($i = 0; $i < count($filesa); $i++)
          {
	            $renames_files .= '<tr>
				                     <td>Nombre:</td>
	                                 <td>
									    <input type="text" name="nombre'.$i.'" maxlength="50" size="50" value="'.$filesa[$i].'" />
										<input name="files'.$i.'" type="hidden" id="files'.$i.'" value="'.$filesa[$i].'" />
									 </td>
								   </tr>';
          }
	         $renames_files .= '<tr><td>Carpeta:</td><td><b>'.$carpeta.'</b></td></tr>';
             $phpSM = '<form action="" method="post" name="form1" id="form1">
                      <table border="0" class="formul" cellspacing="0">
                        <tr class="titulo_dialogo"><td>&nbsp;&nbsp;Renombrar archivos y carpetas</td></tr>
						<tr><td>
						  <table cellpadding="3">
						    '.$renames_files.'
	                        <tr><td colspan="2">
		                      <input name="carpeta" type="hidden" id="carpeta" value="'.$carpeta.'" />
							  <input name="valor" type="hidden" id="valor" value="2" />
							  <input name="type" type="hidden" id="type" value="'.$type.'" />
							  <input name="total" type="hidden" id="total" value="'.$total.'" />
							  <input name="mod" type="hidden" id="mod" value="rename" />
							  '.$validation.'
                            </td></tr>
						  </table>
						 </td></tr>
						</table>
					  </form>';
      }
   }elseif($valor == 2)
   {
      $type = $_POST['type'];
      if($type == 1)
	  {
	     for($i = 0; $i <= $total; $i++)
         {
             if(isset($_POST['files'.$i]))
             {
			   $old_name[] = $carpeta.$_POST['files'.$i];
			   $new_name[] = $carpeta.$_POST['nombre'.$i];
             }
         }
     }elseif($type == 2)
     {
         $old_name[0] = $carpeta;
         $new_name[0] = substr($carpeta,0,strrpos($carpeta,"/"));
         $new_name[0] = substr($new_name[0],0,strrpos($new_name[0],"/") + 1);
	     $new_name[0] = $new_name[0].$_POST['nombre0'];
     }
     if($_POST['valida_action'])
     {
          for($i = 0; $i < count($new_name); $i++)
	      {
	         if(!file_exists($new_name[$i]))
	         if(!@rename($old_name[$i],$new_name[$i])){
			    $error_rename = 1;
				$phpSM .= "<font color=\"red\">No se pudo renombrar <b>".@basename($old_name[$i])."</b>.
				            Revise los permisos.</font><br><br>";
			 }
	      }
		  if($type == 2 && $error_rename != 1){
		     $_SESSION['phpSM_Folder'] = $new_name[0];
		     header("Location: ".$_SERVER['PHP_SELF']);
		     exit;
		  }
     }
   }
}elseif($mod == "delete")
{
   if($valor == 1)
    {
      if(isset($_POST['delete_files']))
      {
         $files = "";
         for($c = 0; $c <= $total; $c++)
	     {
           if(isset($_POST['files'.$c]))
	       {
	          $fil = $_POST['files'.$c];
		      $files .= "<br>".$fil;
	          $files .= '<input name="files'.$c.'" type="hidden" id="files'.$c.'" value="'.$fil.'" />';
	       }
        }
        if($c > 0)
        { 
	           if($c == 1)
	           $files = 'Confirma que desea eliminar el archivo: <b>'.$files.'</b>';
	           else
	           $files = 'Confirma que desea eliminar los siguientes archivos: <b>'.$files.'</b>';
	           $phpSM = '<form action="" method="post" name="form1" id="form1">
                          <table border="0" class="formul" cellspacing="0">
                           <tr class="titulo_dialogo"><td>&nbsp;&nbsp;Eliminar archivos</td></tr>
			               <tr><td>
	                         <table cellpadding="3">
				               <tr><td>'.$files.'</td></tr>
				               <tr><td>Origen: <b>'.$carpeta.'</b></td></tr>
				               <tr><td>
				              '.$validation.'
				              <input name="total" type="hidden" id="total" value="'.$total.'" />
				              <input name="carpeta" type="hidden" id="carpeta" value="'.$carpeta.'" />
				              <input name="valor" type="hidden" id="valor" value="2" />
				              <input name="mod" type="hidden" id="mod" value="delete" />
                              </td>
                            </tr></table>
				           </td></tr>
				          </table>
			             </form>';
         }
     }elseif(isset($_POST['delete_folder']))
     {
	        $phpSM = '<form action="" method="post" name="form1" id="form1">
                       <table border="0" class="formul" cellspacing="0">
	                    <tr class="titulo_dialogo"><td>&nbsp;&nbsp;Eliminar carpeta</td></tr>
	                    <tr><td>
						 <table cellpadding="3">
						  <tr><td>
						    Confirma que desea eliminar todo el contenido de la carpeta:<br> "<b>'.$carpeta.'</b>"<br>
							<br><b><font color="red">Se eliminar&aacute;n los siguientes archivos y carpetas:</font></b><br>
							'.list_dir_files($carpeta).'
						  </td></tr>
						  <tr><td>
						    <input name="files" type="hidden" id="files" value="'.$carpeta.'" />
							<input name="carpeta" type="hidden" id="carpeta" value="'.$carpeta.'" />
							<input name="valor" type="hidden" id="valor" value="3" />
							<input name="mod" type="hidden" id="mod" value="delete" />
							'.$validation.'
						  </td></tr>
                         </table>
	                    </td></tr>
                       </table>
                      </form>';
      }
   }elseif($valor == 2)
   {
      if($_POST['valida_action'])
	  {
	    for($c = 0; $c <= $total; $c++)
	    {
	       if(isset($_POST['files'.$c]))
	       {
	          $fil = $carpeta.$_POST['files'.$c];
		      if(!@unlink($fil))
			  {
			     $phpSM .= "<font color=\"red\">No se pudo eliminar el archivo <b>".@basename($fil)."</b>.
				            Revise los permisos de este archivo.</font><br><br>";
			  }
	       }
	    }
	 }
   }elseif($valor == 3)
   {
      $fil = $_POST['files'];
	  if($_POST['valida_action'])
	  {
	     if(!remove_dir($fil))
		 {
		    $phpSM .= "<font color=\"red\">No se pudo eliminar el directorio <b>".@basename($fil)."</b>.
				            Revise los permisos de esta carpeta.</font><br><br>";
		 }else{
		    header("Location: ".$_SERVER['PHP_SELF']."?carpeta=-1");
		    exit;
		 }
	  }
   }
}elseif($mod == "download")
{
   $old_name = $carpeta.$_GET['files'];
   if(is_file($old_name))
   {
      $filename = $_GET['files'];
      header("Content-Disposition: attachment; filename=\"$filename\"");
      @readfile($old_name);
      exit;
   }else{
          header("Location: ".$_SERVER['PHP_SELF']);
          exit;
	    }
}elseif($mod == "edition")
{
   $phpSM = "";
   if($valor == 1)
   {
      if(isset($_POST['valida_action']) || isset($_POST['save_edition']))
	  {
	      $data_files = trim(stripcslashes($_POST['file_cfg_new']));
	      if(!@file_put_contents($_POST['fichero'],$data_files))
		  {
		     $_POST['save_edition'] = 1;
			 $phpSM = "<font color=\"red\">ERROR! No se pudo escribir en el archivo.<br>
			           Verifique que hay permisos de escritura sobre este archivo.</font><br><br>";
		  }
	  }
	  if(!isset($_POST['save_edition'])){
	      header("Location: ".$_SERVER['PHP_SELF']);
	      exit;
	  }
   }
   if(is_file($carpeta.$_GET['files']))
   {
	     $fichero = $carpeta.$_GET['files'];
	     $lineas = @file_get_contents($fichero);
	     $lineas = htmlspecialchars($lineas);
         $lineas = trim($lineas);
         $phpSM .= '<form name="form1" method="post" action="">
		             <table width="100%" class="formul" cellspacing="0">
                       <tr><td class="titulo_dialogo">&nbsp;&nbsp;Editar archivos</td></tr>
					    <tr><td>
					     <table cellpadding="3" width="100%">
					      <tr><td>Archivo: <b>'.$fichero.'</b></td></tr>
					      <tr><td><textarea name="file_cfg_new" rows="25" style="width:95%;">'.$lineas.'</textarea></td></tr>
					      <tr><td><input name="valor" type="hidden" id="valor" value="1" />
					        <input name="fichero" type="hidden" id="fichero" value="'.$fichero.'" />
					        <input name="carpeta" type="hidden" id="carpeta" value="'.$carpeta.'" />
					        <input name="mod" type="hidden" id="mod" value="edition" />
							<br><b><font color="red">AVISO ! !<br>
				            Realizar cambios pueden afectar el correcto funcionamiento del sitio.</font></b><br>
							<input type="submit" name="valida_action" value="Aceptar" />
		                    <input type="submit" name="cancelar" value="Cancelar" />
							<input name="save_edition" type="submit" value="Aplicar" />
						  </td></tr>
						</table>
					  </td></tr>
				    </table>
				  </form>';
   }
}

if(empty($phpSM))
{
/***BEGIN PROCESS LIST FILES AND FOLDER***/
//begin creacion de objetos de carpetas y ficheros...
$files = list_files($carpeta);
$folder = list_dir($carpeta);
//Begin lista de archivos...
$alter_color = false;
$files_options = '<table width="100%" cellpadding="3" cellspacing="0">
                    <tr class="encabezado_datos">
                      <td>&nbsp;</td>
					  <td align="left">Nombre</td>
					  <td align="left">Acci&oacute;n</td>
					  <td align="right">Tama&ntilde;o</td>
					  <td align="center">Modificado</td>
				    </tr>';
if(count($files) || count($folder))
{
   for($i = 0; $i < count($files); $i++)
   {
      $date_file = date_file($carpeta.$files[$i]);
      $action = '';
	  if($this_permisos[0] == "*" || @array_search("download",$this_permisos) !== false)
      $action .= '<a href="?mod=download&files='.$files[$i].'" title="Descargar archivo">Descargar</a>';
	  if($this_permisos[0] == "*" || @array_search("edit",$this_permisos) !== false)
      if(extenciones($files[$i]) !== false)
	  {
         if($action != "")
		 $action .= ' | ';
		 $action .= '<a href="?mod=edition&files='.$files[$i].'" title="Editar archivo">Editar</a>';
	  }
      if($alter_color)
      $bgColor = ' class="alter_color"';
      else $bgColor = "";
      $alter_color = !($alter_color);
      $files_options .= '<tr'.$bgColor.'>
	                       <td align="right">
						      <input type="checkbox" name="files'.$i.'" id="files'.$i.'" value="'.$files[$i].'"/>
						   </td>
                           <td align="left"><label for="files'.$i.'"><a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].'/'.$files[$i].'">'.$files[$i].'</a></label></td>
						   <td align="left">'.$action.'</td>
						   <td align="right">'.$date_file[0].$date_file[1].'</td>
						   <td align="center">'.$date_file[2].'</td>
					     </tr>';
   }
   for($i = 0; $i < count($folder); $i++)
   {
      $date_file = date_file($carpeta.$folder[$i]);
      if($alter_color)
      $bgColor = ' class="alter_color"';
      else $bgColor = "";
      $alter_color = !($alter_color);
      $files_options .= '<tr'.$bgColor.'>
	                       <td align="right">&nbsp;</td>
                           <td align="left">'.$folder[$i].'</td>
						   <td align="left" colspan="2">
						     <a href="?carpeta='.($i+1).'" title="Abrir carpeta '.$folder[$i].'">Abrir carpeta</a>
						   </td>
						   <td align="center">'.$date_file[2].'</td>
					     </tr>';
   }
   $bto_eliminate = "";
   if($this_permisos[0] == "*" || @array_search("copyA",$this_permisos) !== false)
   $bto_eliminate = '<input type="submit" name="copy_files" value="Copiar Archivos" />';
   if($this_permisos[0] == "*" || @array_search("renameA",$this_permisos) !== false)
   $bto_eliminate .= '<input type="submit" name="rename_files" value="Renombrar Archivos" />';
   if($this_permisos[0] == "*" || @array_search("deleteA",$this_permisos) !== false)
   $bto_eliminate .= '<input type="submit" name="delete_files" value="Eliminar Archivos" />';
}else
{
   $files_options .= '<tr><td align="center" colspan="5"><b>Esta carpeta est&aacute; vac&iacute;a</b></td></tr>';
}
$files_options .= "</table>";
/***end files...***/

//lista de carpetas...
$new_dir_a = dirname($CONFIG_URL_ADMIN);
$new_dir_a = add_slash($new_dir_a);
$new_dir_a = substr($carpeta,strlen($new_dir_a));
$new_dir_a = @explode("/",$new_dir_a);
$c = count($new_dir_a) - 2;
$space = "&nbsp; ";
$carpeta_options = '<select name="carpeta">';
$folder_options = '<table width="100%">';
if($carpeta != $CONFIG_URL_ADMIN)
{
   $subir_nivel = '<a href="?carpeta=-1" title="Subir un nivel"><-- Subir un nivel</a>';
   $folder_options .= '<tr'.$bgColor.'><td align="left">'.$subir_nivel.'</td></tr>';
}
$total_new_dir_a = count($new_dir_a) - 1;
for($i = 0; $i < $total_new_dir_a; $i++)
{
   if($i == $total_new_dir_a - 1)
   $selec = ' selected="selected"';
   $carpeta_options .= '<option value="-'.$c.'"'.$selec.'>'.$space.$new_dir_a[$i].'</option>';
   if($alter_color)
   $bgColor = ' class="alter_color"';
   else $bgColor = "";
   $alter_color = !($alter_color);
   if($i != $total_new_dir_a - 1)
   $enlace_folder = '<a href="?carpeta=-'.$c.'" title="Abrir carpeta '.$new_dir_a[$i].'">'.$space.$new_dir_a[$i].'</a>';
   else $enlace_folder = "<b>".$space.$new_dir_a[$i]."</b>";
   $folder_options .= '<tr'.$bgColor.'><td align="left">'.$enlace_folder.'</td></tr>';
   $space .= "&nbsp; ";
   $c --;
}
for($i = 0; $i < count($folder); $i++)
{
    $carpeta_options .= '<option value="'.($i+1).'">'.$space.$folder[$i].'</option>';
	if($alter_color)
    $bgColor = ' class="alter_color"';
    else $bgColor = "";
    $alter_color = !($alter_color);
	$folder_options .= '<tr'.$bgColor.'>
			<td align="left"><a href="?carpeta='.($i+1).'" title="Abrir carpeta '.$folder[$i].'">'.$space.$folder[$i].'</a></td>
					    </tr>';
}
$folder_options .= "</table>";
$carpeta_options .= '</select>';
/***end folders...***/

$bto_op = '<table width=100%>
            <tr>
			  <td align="left">Carpeta actual: <b>'.@implode("/",$new_dir_a).'</b><br>
				  '.count($files).' archivos y '.count($folder).' carpetas</td>
			  <td align="right">'.$bto_eliminate.'</td>
		    </tr>
			<tr><td colspan="2"><hr width="98%" class="formul"></td></tr>
		   </table>';
$table_datos = '<table width=100%>
				  <tr><td colspan="2">'.$bto_op.'</td></tr>
                  <tr>
				    <td valign="top" width="180" class="division">'.$folder_options.'</td>
				    <td valign="top">'.$files_options.'</td>
				  </tr>
				</table>';
/* end declaracion de archivos y carpetas...*/
/***END PROCESS LIST FILES AND FOLDER***/
    if($adm == "newfolder")
	$add_recurso = $add_folder;
	elseif($adm == "upload")
	$add_recurso = $upload;
	else $add_recurso = "";
	
	if(count($_SESSION['phpSM_Copy']) == 1 && substr($carpeta,0,strlen($_SESSION['phpSM_Copy'][0])) != $_SESSION['phpSM_Copy'][0]
	&& $carpeta != add_slash(@dirname($_SESSION['phpSM_Copy'][0]))) 
	$bto_pegar = '<input type="submit" name="paste_folder" value="Pegar Carpeta" />';
	elseif(count($_SESSION['phpSM_Copy']) > 1 && $_SESSION['phpSM_Copy'][0] != $carpeta) 
	$bto_pegar = '<input type="submit" name="paste_files" value="Pegar Archivos" />';
	
	$bto_admin_folder = "";
	if($this_permisos[0] == "*" || @array_search("copyF",$this_permisos) !== false)
	$bto_admin_folder .= '<input type="submit" name="copy_folder" value="Copiar Carpeta" />';
	if($this_permisos[0] == "*" || @array_search("renameF",$this_permisos) !== false)
	$bto_admin_folder .= '<input type="submit" name="rename_folder" value="Renombrar Carpeta" />';
	if($this_permisos[0] == "*" || @array_search("deleteF",$this_permisos) !== false)
	$bto_admin_folder .= '<input type="submit" name="delete_folder" value="Eliminar Carpeta" />';
	$phpSM = $add_recurso.'<form action="" method="post" name="form1" id="form1">
                 <table border="0" class="formul" cellspacing="0">
				  <tr class="titulo_dialogo"><td>&nbsp;&nbsp;Administrar archivos y carpetas</td></tr>
				  <tr><td>
				   <table cellpadding="3" width="100%">
				    <tr>
                     <td>Carpetas:</td>
                     <td>'.$carpeta_options.'</td>
                    </tr>
                    <tr>
	                 <td>&nbsp;</td>
                     <td align="left">
					   <input name="valor" type="hidden" id="valor" value="1" />
					   <input type="submit" value="Actualizar Carpeta" />
					   '.$bto_admin_folder.$bto_pegar.'
					   <input name="total" type="hidden" id="total" value="'.count($files).'" />
                      </td>
                     </tr>
	                 <tr><td colspan="2" align="center">'.$table_datos.'</td></tr>
					</table>
				   </td></tr>
				  </table>
				 </form>';
}

$list_op_adm = '<div align="right">';
$list_op_adm .= '<font color="#00CCCC">'.strtoupper($CONFIG_USERS_ADMIN[$user_id]).'</font> |
                 <a href="?adm=out">CERRAR SESI&Oacute;N</a><br style="margin-bottom:5px;">';
$list_op_adm .= '<a href="templates/myadmin.php">BASE DE DATOS</a> | ';
$list_op_adm .= '<a href="'.$_SERVER["PHP_SELF"].'">ARCHIVOS Y CARPETAS</a>';
if($this_permisos[0] == "*" || @array_search("upload",$this_permisos) !== false)
$list_op_adm .= ' | <a href="?adm=upload">SUBIR ARCHIVOS</a>';
if($this_permisos[0] == "*" || @array_search("newF",$this_permisos) !== false)
$list_op_adm .= ' | <a href="?adm=newfolder">CREAR CARPETAS</a>';
if($this_permisos[0] == "*" || @array_search("conf",$this_permisos) !== false || @array_search("changePW",$this_permisos) !== false)
$list_op_adm .= ' | <a href="?adm=config">CONFIGURACI&Oacute;N</a>';
$list_op_adm .= '</div>';
}else
{
unset($error);
if(($clave = @array_search($_POST['user'],$CONFIG_USERS_ADMIN)) !== false)
if(md5($_POST['pass']) == $CONFIG_CLAVE_ADMIN[$clave])
{
   $_SESSION['phpSiteManager'] = md5($CONFIG_CLAVE_ADMIN[$clave]);
   $_SESSION['phpSiteManager_UserID'] = $clave;
   header("Location: ".$_SERVER['PHP_SELF']);
   exit;
}else $error = "<tr><td colspan=\"2\"><font color=\"red\">ERROR! Acceso denegado.</font><br><br></td></tr>";
//formul adminitrator validations...
$phpSM = '<form name="form1" method="post" action="">
                 <table align="center">
				   '.$error.'
				   <tr>
				     <td align="right">Usuario:</td>
					 <td><input type="text" name="user" value="'.$_POST['user'].'"></td>
				   </tr>
				   <tr>
				     <td align="right">Contrase&ntilde;a:</td>
					 <td><input type="password" name="pass"></td>
				   </tr>
				   <tr>
				     <td>&nbsp;</td>
				     <td><input type="submit" value="Enviar"></td>
				   </tr>
				 </table>
			   </form>';
$list_op_adm = '<div><a href="'.$CONFIG_URL_SITE[0].'">'.$CONFIG_TITLE[0].'</a></div>';
}
}
$title = $CONFIG_TITLE[$user_id = (is_int($user_id) != false && $CONFIG_TITLE[$user_id] != "") ? $user_id:0];
if($title == "")
$title = "phpSiteManager";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo $title;?></title>
<style type="text/css">
body{
   font-family: Verdana, Arial, Helvetica, sans-serif;
   font-size: 11px;
   margin: 0;
   background: #F2F5F7;
}
a:link, a:visited, a:active{
   color: #0000FF;
   text-decoration: none;
}
a:hover{
   text-decoration: none;
   color: #FF0000;
}
table, tr, td, th, caption, p, ul, ol, li, label, legend, input, select, a, div, pre{
   font-size: 100%;
   font-family: Verdana, Arial, Helvetica, sans-serif;
}
legend{
   font-weight: bold;
}
fieldset{
   border: 1px solid #A0A0A0;
}
.header{
   font-size: 25px;
   font-style: oblique;
   font-variant: small-caps;
   font-weight: bold;
   color: #FFFFFF;
   margin-bottom: 10px;
   padding-left: 10px;
   background-color: #000066;
}
#header_menu{
   position: absolute;
   right: 15px;
   top: 0px;
   font-size: 10px;
   font-weight: bold;
   color: #FFFFFF;
   margin-bottom: 10px;
}
#header_menu a:link, #header_menu a:visited, #header_menu a:active{
   color: #FFFFFF;
   text-decoration: none;
}
#header_menu a:hover{
   text-decoration: none;
   color: #FFFF00;
}
.formul{
   background-color: #F2F5F7;
   border: 1px solid #A9C8DD;
   width: 100%;
}
.titulo_dialogo{
   background-color: #094EA2;
   color: #FFFFFF;
   font-size: 12px;
   font-weight: bold;
}
.encabezado_datos{
   background-color: #094EA2;
   color: #FFFFFF;
   font-size: 12px;
   font-weight: bold;
}
.division{
   border-right:1px solid #094EA2;
   border-width:2px;
}
.alter_color{
   background-color:#D2E3EC;
}
.creditos{
    font-size:10px;
    color:#A0A0A0;
	margin-top:20px;
}
</style>
<script>
function text_focus(form) 
{
   if(typeof document.forms[form] != 'undefined')
   for (var i = 0; i < document.forms[form].elements.length; i++)
   {
      if(document.forms[form].elements[i].type == "text" || document.forms[form].elements[i].type == "password")
	  {
         if(document.forms[form].elements[i].value == "" ||
		    (document.forms[form].elements[i+1].type != "text" && document.forms[form].elements[i+1].type != "password"))
		 {
			document.forms[form].elements[i].focus();
            return true;
			break;
		 }
      }
   }
   form ++;
   if(typeof document.forms[form] != 'undefined')
   text_focus(form)
}
</script>
</head>

<body onload="javascript: text_focus('0');">
<div class="header">phpSiteManager</div>
<div id="header_menu"><? echo $list_op_adm;?></div>
<table width="98%" align="center">
  <tr>
    <td><? echo $phpSM;?></td>
  </tr>
</table>
<div class="creditos" align="center">
<a href="index.php"><?php echo $_SERVER['HTTP_HOST'];?></a> 
Copyright &copy; phpSiteManager.
Todos los derechos reservados.
Modificado por Multiportal.
</div>
</body>
</html>