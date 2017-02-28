<?php

session_start();
include 'tipoconexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ((isset($_POST['mail'])) and ( isset($_POST['password'])) and ( $_POST['password'] != '') and ( $_POST['mail'] != '')) {
        $password = $_POST['password'];
        $sql = "Select * from usuario  where mail='" . $_POST['mail'] . "' and clave=md5('$password');";
        $seleccion = mysql_query($sql);
     

        if (mysql_num_rows($seleccion) > 0) {
            while ($resultados = mysql_fetch_assoc($seleccion)) {
                $_SESSION['usuario'] = $resultados['mail'];
                $_SESSION['idusuario'] = $resultados['id_usuario'];
                $_SESSION['mail'] = $resultados['mail'];
                $_SESSION['perfil'] = $resultados['id_perfil'];
//                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['SKey'] = uniqid(mt_rand(), true);
                $_SESSION['start'] = time(); // Taking now logged in time.
//////            // Ending a session in 30 minutes from the starting time.
                $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
//                $_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];
//                $ip = !empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
//                $_SESSION['IPaddress'] = $ip;

                $texto = "select * from personas2 p  where idusuario=" . $_SESSION['idusuario'];
                $consultapersona = mysql_query($texto);
                if (mysql_num_rows($consultapersona) > 0) {
                    $Regpersonas = mysql_fetch_assoc($consultapersona);
                    $_SESSION['nombre'] = $Regpersonas['nombre'];
                   if (isset($Regpersonas['nombre'] )) {
                        $_SESSION['idpersona']=$Regpersonas['idpersonas'];
                        $persona=TRUE;
                    } else { 
                        $persona=FALSE;
                        
                    }
                    header("location: ../index.php");
                    exit;
                } else {
                    
                    header("location: ../vistas/perfil.php");
                    exit;
                }
            }
        } else {
            header("location: ../vistas/errorsession.php");
            exit;
        }
        mysql_free_result($seleccion);
    }
} 
  