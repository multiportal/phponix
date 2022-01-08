<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">
    <!-- Estilos -->
    <link rel="stylesheet" href="<?php echo $page_url;?>modulos/login/css/style.css">
    <title>Login y Registro de Usuarios</title>
</head>
<body>
    <div class="text-center">
        <a href="<?php echo $page_url;?>">
            <img class="logo-sesion" src="<?php echo $page_url.$path_tema.'images/'.$logo;?>">
        </a>
    </div>
   <!-- Formularios -->
    <div class="contenedor-formularios">
        <!-- Links de los formularios -->
        <ul class="contenedor-tabs">
            <li class="tab tab-segunda active"><a href="#iniciar-sesion">Iniciar Sesión</a></li>
            <li class="tab tab-primera"><a href="#registrarse">Registrarse</a></li>
        </ul>

        <!-- Contenido de los Formularios -->
        <div class="contenido-tab">
            <!-- Iniciar Sesion -->
            <div id="iniciar-sesion">
                <h1>Iniciar Sesión</h1>
                <form id="form_login" method="POST" action="">
                    <div id="msj-error" class="contenedor-input"></div>
                    <div class="contenedor-input">
                        <label>
                            Usuario <span class="req">*</span>
                        </label>
                        <input id="username" name="username" type="text" required>
                    </div>

                    <div class="contenedor-input">
                        <label>
                            Contraseña <span class="req">*</span>
                        </label>
                        <input id="password" name="password" type="password" required>
                    </div>
                    <p class="forgot"><a href="#">Se te olvidó la contraseña?</a></p>
                    <input type="submit" class="button button-block" value="Iniciar Sesión">
                </form>
            </div>

            <!-- Registrarse -->
            <div id="registrarse">
                <h1>Registrarse</h1>
                <form id="form_reg" method="POST" action="">
                    <div class="fila-arriba">
                        <div class="contenedor-input">
                            <label>
                                Nombre <span class="req">*</span>
                            </label>
                            <input  type="text" required >
                        </div>

                        <div class="contenedor-input">
                            <label>
                                Apellido <span class="req">*</span>
                            </label>
                            <input type="text" required>
                        </div>
                    </div>
                    <div class="contenedor-input">
                        <label>
                            Usuario <span class="req">*</span>
                        </label>
                        <input type="text" required>
                    </div>
                    <div class="contenedor-input">
                            <label>
                                Email <span class="req">*</span>
                            </label>
                        <input type="email" required>
                    </div>
                    <div class="contenedor-input">
                        <label>
                            Contraseña <span class="req">*</span>
                        </label>
                        <input type="password" required>
                    </div>

                    <div class="contenedor-input">
                        <label>
                            Repetir Contraseña <span class="req">*</span>
                        </label>
                        <input type="password" required>
                    </div>

                    <input type="submit" class="button button-block" value="Registrarse">
                </form>
            </div>
        </div>
    </div>
    <?php echo $jQuery10;?>
   <script src="<?php echo $page_url;?>modulos/login/js/script.js"></script>
   <script type="text/javascript" src="<?php echo $page_url;?>api/login/index.js"></script>
</body>
</html>