<?php
require('../controles/tipoconexion.php');
$token = $_GET['token'];
$idusuario = $_GET['idusuario'];

$conexion =new mysqli($host, $user, $clave, $base);
/* Comprueba la conexión */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 
$sql = "SELECT * FROM tblreseteopass ";

//WHERE token = '$token'

$resultado = $conexion->query($sql);

if ($conexion->error) {
    try {    
        throw new Exception("MySQL error $conexion->error <br> Query:<br> $query", $conexion->errno);    
    } catch(Exception $e ) {
        echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
        echo nl2br($e->getTraceAsString());
    }
}
if( $resultado->num_rows > 0 ){
    
   $usuario = $resultado->fetch_array(MYSQLI_ASSOC);
//   printf("Errormessage: %s\n", $conexion->error);
  
   if( sha1($usuario['idusuario']) == $idusuario ){
     
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include'../cabezera.php' ?>
 </head>
 
  <body>
        <header>
            <?php include '../barra.php'; ?> 
        </header> 
      
  <div class="container" role="main">
   <div class="col-md-4"></div>
   <div class="col-md-4">
    <form action="cambiarpassword.php" method="post">
     <div class="panel panel-default">
      <div class="panel-heading"> Restaurar contraseña </div>
      <div class="panel-body">
       <p></p>
       <div class="form-group">
        <label for="password"> Nueva contraseña </label>
        <input type="password" class="form-control" name="password1" required/>
       </div>
       <div class="form-group">
        <label for="password2"> Confirmar contraseña </label>
        <input type="password" class="form-control" name="password2" required/>
       </div>
       <input type="hidden" name="token" value="<?php echo $token ?>">
       <input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
       <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Recuperar contraseña" >
       </div>
      </div>
     </div>
    </form>
   </div>
  <div class="col-md-4"></div>
  </div> <!-- /container -->
 
  
 </body>
</html>
<?php
   }
   else{
     header('Location:index.php?estado=passworddesiguales');
   }
 }
 else{
     header('Location:index.php?estado=noexisteresultado');
 }
?>
