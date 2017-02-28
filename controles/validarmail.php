<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'tipoconexion.php';
//
$GLOBALS['h'] = $host;
$GLOBALS['u'] = $user;
$GLOBALS['c'] = $clave;
$GLOBALS['b'] = $base;

function generarLinkTemporal($idusuario, $username) {
    // Se genera una cadena para validar el cambio de contraseña
    $cadena = $idusuario . $username . rand(1, 9999999) . date('Y-m-d');
    $token = sha1($cadena);

    $conexion = new mysqli($GLOBALS["h"], $GLOBALS["u"], $GLOBALS["c"], $GLOBALS["b"]);
    // Se inserta el registro en la tabla tblreseteopass
    $sql = "INSERT INTO tblreseteopass (idusuario, username, token, creado) VALUES($idusuario,'$username','$token',NOW());";
    $resultado = $conexion->query($sql);
    if ($resultado) {
        // Se devuelve el link que se enviara al usuario
        $enlace = $_SERVER["SERVER_NAME"] . '/noticias/vistas/restablecer.php?idusuario=' . sha1($idusuario) . '&token=' . $token;
        return $enlace;
    } else
        return FALSE;
}

function enviarEmail($email, $link) {
    $mensaje = '<html>
     <head>
        <title>Restablece tu contraseña</title>
     </head>
     <body>
       <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
       <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
       <p>
         <strong>Enlace para restablecer tu contraseña</strong><br>
         <a href="http://' . $link . '"> Restablecer contraseña </a>
            </p>
     </body>
    </html>';
//    $to = "miranda.federico@inta.gob.ar";
    $de = "sm@smg.gob.ar";
    $nombre = "webmaster";
    $subject = "password";
    
    $headers = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[]= "Content-Type: text/html; charset=UTF-8";
    $headers[] = "From: {$nombre} <{$de}>";
    $headers[] = "Bcc: Administrador <info@informaciontecn.com.ar>";
    $headers[] = "Reply-To: {$nombre} <{$de}>";
    $headers[] = "Subject: {$subject}";
    
    $headers[] = "X-Mailer: PHP/" . phpversion();
    // Se envia el correo al usuario
    mail($email, $subject, $mensaje, implode("\r\n", $headers));
}

$email = $_POST['email'];

$respuesta = new stdClass();

if ($email != "") {
    $conexion = new mysqli($host, $user, $clave, $base);
    $sql = " SELECT * FROM usuario WHERE mail = '$email' ";
    $resultado = $conexion->query($sql);
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        $linkTemporal = generarLinkTemporal($usuario['id_usuario'], $usuario['mail']);
        if ($linkTemporal) {
            enviarEmail($email, $linkTemporal);
            echo '<div class="alert alert-info"> Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña </div>';
        }
    } else
        echo'<div class="alert alert-warning"> No existe una cuenta asociada a ese correo. </div>';
} else
    echo "Debes introducir el email de la cuenta";
//echo json_encode($respuesta);
