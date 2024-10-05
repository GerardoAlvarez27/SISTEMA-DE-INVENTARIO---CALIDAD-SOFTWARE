<?php
include('config.php');

// Inicia la sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variables para botones de inicio de sesión
$google_login_button = '';
$credentials_login_button = '';

// Maneja la autenticación con Google
if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        $_SESSION['user_first_name'] = $data['given_name'] ?? '';
        $_SESSION['user_last_name'] = $data['family_name'] ?? '';
        $_SESSION['user_email_address'] = $data['email'] ?? '';
        $_SESSION['user_gender'] = $data['gender'] ?? '';
        $_SESSION['user_image'] = $data['picture'] ?? '';

        // Redirige a admin.php después de la autenticación exitosa
        header('Location: admin.php');
        exit();
    }
}

// Verifica si el usuario ya está autenticado
if (!isset($_SESSION['access_token'])) {
    $google_login_button = '<a href="'.$google_client->createAuthUrl().'"><button type="button">Iniciar Sesión con Google</button></a>';
}

// Botón de inicio de sesión con credenciales
$credentials_login_button = '<button type="button" onclick="document.getElementById(\'credentials-form\').style.display=\'block\'">Usuario y Contraseña</button>';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Pagina Inicio Sesion Oauth</title>  
</head>

<body>
    <style>
        #login-box {
            width: 30%;
            text-align: center;
            margin: 0 auto;
            margin-top: 10%;
            background: #000000d3;
            padding: 20px 50px;
        }
    
        #login-box h1 {
            color: white;
        }
        /*caja del formulario*/
        #login-box .form .item input {
            width: 200px;
            border: 0;
            border-bottom: 5px solid white;
            font-size: 18px;
            background: #ffffff00;
            color: white;
            padding: 5px 10px;
        }
        /*imagen de fondo*/
        body {
            background: url("https://img.freepik.com/fotos-premium/marco-cajas-carton-entrega-o-mudanza-pila-cajas-espacio-copia-fondo-azul_188237-707.jpg") center;
            height: 100%;
            margin: 0;
            background-size: cover;
            background-repeat: no-repeat;
        }
        /*boton*/
        #login-box button {
            border: 0;
            width: 250px;
            height: 40px;
            margin-top: 18px;
            font-size: 18px;
            color: white;
            border-radius: 25px;
            background-color: rgb(136, 136, 136);
        }
        /* formulario de credenciales oculto inicialmente */
        #credentials-form {
            display: none;
            margin-top: 20px;
        }
    </style>

    <div id="login-box">
        <h1>SISTEMA DE INVENTARIOS</h1>
        
        <!-- Botones de inicio de sesión -->
        <?php
        if (isset($_SESSION['access_token'])) {
            echo '<h3>Bienvenido '.$_SESSION['user_first_name'].'</h3>';
            echo '<img src="'.$_SESSION["user_image"].'" />';
            echo '<h3><a href="logout.php">Cerrar Sesión</a></h3>';
        } else {
            echo $google_login_button;
            echo '<br>';
            echo $credentials_login_button;
        }
        ?>

        <!-- Formulario de inicio de sesión con credenciales -->
        <div id="credentials-form">
            <form action="login.php" method="post">
                <div class="item">
                    <input type="text" placeholder="Usuario" name="username">
                </div>
                <div class="item">
                    <input type="password" placeholder="Contraseña" name="password">
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>