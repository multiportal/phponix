<?php
if (isset($mod) && $mod != '') {
    open_page();
?>
Registro 
<?php
    close_page();
}else{
    include '../../admin/conexion.php';
    open_page_form();
    //$URL=$page_url.'admin/';
    if ($_GET['code']==1){
        if (isset($_POST['enviar'])){
            $cod = $_POST['cod'];
            $sql = mysqli_query($mysqli,"SELECT * FROM ".$DBprefix."signup WHERE actualizacion='{$cod}';") or print mysqli_error($mysqli);
            $num_rows = mysqli_num_rows($sql);
            if ($num_rows != 0) {
                if($row = mysqli_fetch_array($sql)){$id_login = $row['ID'];}
                $save = mysqli_query($mysqli, "UPDATE " . $DBprefix . "signup SET activo=1 WHERE ID='{$id_login}';") or print mysqli_error($mysqli);
                session_start();session_unset();session_destroy();
                validar_aviso($save, 'El codigo es valido, ahora puede ingresar a cuenta. <a href="' . $page_url . 'admin" style="color:#444;">Iniciar Sesi&oacute;n</a>', 'Hubo un problema, por favor intentelo nuevamente. <a href="' . $URL . '" style="color:#444;">Regresar</a>', $aviso);
            }else{
                validar_aviso($save, '', 'Lo sentimos el c&oacute;digo no existe, intente con uno diferente. <a href="' . $URL . '" style="color:#444;">Regresar</a>', $aviso);
            }
            echo '<div style=" width:600px;margin:280px auto 0 auto;">' . $aviso . '</div>';
        }else{
?>
<div class="container">
   <header>
      <div><img id="logo-s" src="<?php echo $page_url.$path_tema;?>images/logo.min.png" alt="logo" title="logo" /></div>
      <h2>*Ingrese Codigo de confirmaci&oacute;n.</h2>
      <div class="support-note">
         <span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
      </div>
   </header>
   <section class="main">
      <form name="form1" class="form-4" method="POST" action="<?php echo $URL;?>">
         <p>
            <input type="text" id="cod" name="cod" placeholder="Codigo" required> 
         </p>
         <p>
            <input type="submit" name="enviar" value="Continuar">
         </p>
      </form>
      <div style="text-align:center;">
         <a href="<?php echo $page_url;?>admin/" class="alogin">Regresar</a>
      </div>
   </section>
</div>
<?php
        }
    }else{
        sql_opciones('form_registro', $valor);
        if ($valor == 0) {
            validar_aviso($save, '', 'Esta secci&oacute;n esta desactivada temporalmente. <a href="' . $page_url . 'admin/" style="color:#444;">Regresar</a>', $aviso);
            echo '<div style=" width:600px;margin:280px auto 0 auto;">' . $aviso . '</div>';
        }else{
            if (isset($_POST['enviar'])) {
                $nombre        = htmlentities($_POST['nombre']);
                $username      = $_POST['username'];
                $pass          = $_POST['pass'];
                $pass1         = sha1(md5($pass));/* Encriptamos "Ciframos" el password */
                $email         = $_POST['email'];                
                $level         = 5;
                $actualizacion = $username.$year.'x'.$pass;
                $activo        = 0;
                $alta          = $date;
                $codi          = getRandomCode();
                $codigo        = substr($codi, 0, 6);
                $sec           = 'contacto';
                $cat_list      = 'inbox';

                $info      = navegador();
                $navegador = $info['browser'];
                $os        = $info['os'];

                $sql = mysqli_query($mysqli, "SELECT * FROM " . $DBprefix . "signup WHERE username='{$username}' OR email='{$email}';") or print mysqli_error($mysqli);
                $num_rows = mysqli_num_rows($sql);
                if ($num_rows != 0) {
                    validar_aviso($save, '', 'Lo sentimos el usuario o email ya existe, intente con uno diferente. <a href="' . $URL . '" style="color:#444;">Regresar</a>', $aviso);
                }else{
                    
                    $contenido = '';
                    $contenido .= '<tr><td align="right" style="background-color: #eee;">Usuario:</td><td style="background-color: #eee;">' . $username . '</td></tr>';
                    $contenido .= '<tr><td align="right" style="background-color: #fff;">Password:</td><td style="background-color: #fff;">' . $pass . '</td></tr>';
                    $contenido .= '<tr><td align="right" style="background-color: #eee;">Nombre:</td><td style="background-color: #eee;">' . $nombre . '</td></tr>';
                    $contenido .= '<tr><td align="right" style="background-color: #fff;">Correo:</td><td style="background-color: #fff;">' . $email . '</td></tr>';
                    $contenido .= '<tr><td align="right" style="background-color: #eee;">Nivel:</td><td style="background-color: #eee;">' . $level . '</td></tr>';
                    $contenido .= '<tr><td align="right" style="background-color: #fff;"><sttrong>C&oacute;digo de Activaci&oacute;n:</strong></td><td style="background-color: #fff;">' . $actualizacion . '</td></tr>';
                    $contenido .= '<tr><td align="right" style="background-color: #eee;">Activo:</td><td style="background-color: #eee;">' . $activo . '</td></tr>';
                    $contenido .= '<tr><td align="right" style="background-color: #fff;">Alta:</td><td style="background-color: #fff;">' . $alta . '</td></tr>';
                    $contenido .= '<tr><td align="right" style="background-color: #eee;">Codigo de Seguridad:</td><td style="background-color: #eee;">' . $codigo . '</td></tr>';
                    /*---MENSAJE DEL SISTEMA----------------------------------------------------------------------------*/
                    //envio_registro_web($sec, $cat_list, $contenido, $nombre, $email, $aviso1);
                    message_registro($email,$contenido,$para,$titulo,$msj_bien,$msj_mal,$message,$header,1);
            
                    $save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."contacto (ip,nombre,email,asunto,msj,cat_list,seccion,visible) VALUES ('{$ip}','{$nombre}','{$email}','{$titulo}','{$message}','{$cat_list}','{$sec}','1');") or print mysqli_error($mysqli); 
                    validar_aviso($save,$msj_bien,$msj_mal,$aviso);
                    $aviso1=$aviso;
                    mail($para,$titulo,$message,$header);
                    /*------------------------------------------------------------------------------------------------*/
                    
                    /*---MENSAJE CLIENTES----------------------------------------------------------------------------*/
                    //envio_registro_cliente($sec, $cat_list, $contenido, $nombre, $email, $username, $pass, $actualizacion, $aviso2);
                    message_registro($email,$contenido,$para,$titulo,$msj_bien,$msj_mal,$message,$header,0);
                    
                    $save=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."signup (username,password,level,email,tema,nombre,foto,cover,alta,actualizacion,codigo,intentos,activo) VALUES ('{$username}','{$pass1}','5','{$email}','default','{$nombre}','sinfoto.png','sincover.jpg','{$date}','{$actualizacion}','{$codigo}','0','0');") or print mysqli_error($mysqli); 
                    $sql=mysqli_query($mysqli,"INSERT INTO ".$DBprefix."access (user,ip,navegador,os,code,fecha) VALUES ('{$username}','{$ip}','{$navegador}','{$os}','{$codigo}','{$date}');") or print mysqli_error($mysqli);
                    validar_aviso($save,$msj_bien,$msj_mal,$aviso);
                    $aviso2=$aviso;
                    mail($para,$titulo,$message,$header);
                    /*------------------------------------------------------------------------------------------------*/
                }
                $aviso = $aviso1 . $aviso2;
                echo '<div style="width:600px;margin:280px auto 0 auto;">'.$aviso .'</div>';
            }else{
?>
<div class="container">
   <header>
      <div><img id="logo-s" src="<?php echo $page_url . $path_tema;?>images/logo.min.png" alt="logo" title="logo" /></div>
      <h2>Registro de usuario.</h2>
      <div class="support-note">
         <span class="note-ie">Lo sentimos, solo navegadores actualizados.</span>
      </div>
   </header>
   <section class="main">
      <form name="form1" class="form-4" method="POST" action="<?php echo $URL.'?pin=1';?>">
         <p>
         <div class="label">*Ingrese Nombre de Usuario</div>
         <input type="text" id="username" name="username" placeholder="Nombre de Usuario" required> 
         </p>
         <p>
         <div class="label">*Ingrese Password</div>
         <input type="password" id="pass" name="pass" placeholder="Password" required> 
         </p>
         <p>
         <div class="label">*Ingrese Nombre Completo</div>
         <input type="text" id="nombre" name="nombre" placeholder="Nombre Completo" required> 
         </p>
         <p>
         <div class="label">*Ingrese Correo Electronico</div>
         <input type="text" id="email" name="email" placeholder="Correo Electronico" required> 
         </p>
         <p>
            <input type="submit" name="enviar" value="Enviar">
         </p>
      </form>
      <div style="text-align:center;">
         <a href="<?php echo $URL;?>?code=1" class="alogin">Ingresar C&oacute;digo</a> | <a href="<?php echo $page_url;?>admin/" class="alogin">Regresar</a>
      </div>
   </section>
</div>
<?php
            } //$_POST['enviar']
        } //$valor
    } //$_GET['code']
    
    close_page();
}
?>