<?php
require('../controles/tipoconexion.php');
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$idusuario = $_POST['idusuario'];
$token = $_POST['token'];

if ($password1 != "" && $password2 != "" && $idusuario != "" && $token != "") {
    ?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include'../cabezera.php' ?>
 </head>
 
  
        <header>
            <?php include '../barra.php'; ?> 
        </header> 
        <body>
            <div class="container" role="main">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?php
//                    echo $token."<br/>";
                    $conexion = new mysqli($host, $user, $clave, $base);
                    $sql = " SELECT * FROM tblreseteopass WHERE token = '$token' ";
                    $resultado = $conexion->query($sql);
                    if ($resultado->num_rows > 0) {
                        $usuario = $resultado->fetch_assoc();
                        $d=sha1($usuario['idusuario']);
//                        echo "sha1=".$d."id=$idusuario<br/>";
                        if (sha1($usuario['idusuario'] === $idusuario)) {
                            if ($password1 === $password2) {
//                                echo $password1." === ".$password2;
                                $sql = "UPDATE usuario SET clave = '".md5($password1)."' WHERE id_usuario = " . $usuario['idusuario'];
                                $resultado = $conexion->query($sql);
                                if ($resultado) {
                                    $sql = "DELETE FROM tblreseteopass WHERE token = '$token';";
                                    $resultado = $conexion->query($sql);
                                    ?>
                                    <p class="alert alert-info"> La contraseña se actualizó con exito. </p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="alert alert-danger"> Ocurrió un error al actualizar la contraseña, intentalo más tarde </p>
                                    <?php
                                }
                            } else {
                                ?>
                                <p class="alert alert-danger"> Las contraseñas no coinciden </p>
                                <?php
                            }
                        } else {
                            ?>
                            <p class="alert alert-danger"> El token no es válido </p>
                            <?php
                        }
                    } else {
                        ?>
                        <p class="alert alert-danger"> El token no es válido </p>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-2"></div>
            </div> <!-- /container -->
          
        </body>
    </html>
    <?php
} else {
    header('Location:index.php');
}
?>