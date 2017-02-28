<?php

session_start();

include '../controles/tipoconexion.php';


$target_dir = "imagenes/mapas/";

$idregistrador = $_SESSION['idpersona'];
$idpersona=$_POST['idpersona'];
$titulo = $_POST['titulo'];
$encabezado = $_POST['encabezado'];
$observacion ="";// $_POST['observacion'];
$idmedicion=$_POST['medicion'];
$fecha = $_POST['fecha'];
$provincia = $_POST['provincia'];
$estado = $_POST['estado'];


if ($idpersona==$idregistrador){
    
}
if (isset($_POST['idnoticia'])){
 if (Editar($_POST['idnoticia'])){
  echo    $_POST['idnoticia'];
   $uploadOk = 2;
 } elseif ($_POST['idnoticia']=='Alta'){
     $uploadOk = 1;
 }
 
} 


$filenombre = $idpersona . "-" . $fecha;
$nombre_carpeta = $target_dir . $idpersona;

if (!is_dir($nombre_carpeta)) {
    mkdir($nombre_carpeta, 0777);
} else {
    echo "Ya existe ese directorio\n";
// extraer extension del archivo
    $imageFileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
    $imagen = $imageFileType;
    $target_file = $nombre_carpeta . "/" . $filenombre . "." . $imagen;
    echo $target_file;
} 

$imagen = $filenombre . "." . $imageFileType;

//basename($_FILES["file"]["name"]);
// Check if image file is a actual image or fake image
    
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["file"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

//
//// Check if $uploadOk is set to 0 by an error

if($uploadOk>0) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file " . basename($nombre_carpeta . $_FILES["file"]["name"]) . " has been uploaded./n $target_file ";
        $ok = 1;
    } else {
        echo "Sorry, there was an error uploading your file.";
        $ok = 2;
    }
}





if ($ok==1) {

    if ($uploadOk == 2) {
        $idnoticia = $_POST['idnoticia'];
        $consulta = "update `noticias` 
            set 
            titulo ='$titulo' ,
            encabezado='$encabezado' ,
            imagen='$imagen' ,
            fecha= '$fecha',
            idprovincia= '$provincia',
            idmedicion=$idmedicion,    
            estado=$estado    
            where idnoticia=$idnoticia ";


        //Si los datos se introducen correctamente, mostramos los datos
        //Sino, mostramos un mensaje de error, GeomFromText($area)
        if (mysql_query($consulta)) {
            die('Registrado con éxito <br>' .
                    'Se a modificado <br>');
        } else {
            die($consulta);
        }
} 
    if ($uploadOk == 1) {


        $consulta = "INSERT INTO `noticias` (`idnoticia`, `titulo`, `encabezado`, `imagen`, `fecha`, `idprovincia`, `idpersona`,`estado`,`idmedicion`) "
                ."VALUES (null,'$titulo','$encabezado','$imagen','$fecha','$provincia',$idpersona,1,$idmedicion)";

	
        //Si los datos se introducen correctamente, mostramos los datos
        //Sino, mostramos un mensaje de error, GeomFromText($area)
        if (mysql_query($consulta)) {
            die('Registrado con éxito <br>' .
                    'Se a modificado el Perfil<br>');
        } else {
            die($consulta);
        }
    }
}

function Editar($idnoticia){
 if (isset($idnoticia)) {
    $consulta = "select * from noticias where idnoticia=$idnoticia";
    $ver=mysql_query($consulta);
 if ($ver) {
        $resultados = mysql_fetch_assoc($ver);
        if ($resultados['idnoticia']>0) {
            return true;
        } else {
        return false;
        }
    }
 }
}