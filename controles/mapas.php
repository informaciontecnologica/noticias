<?php

session_start();

include '../controles/tipoconexion.php';

$idpersona = $_POST['idpersona'];

$target_dir = "imagenes/mapas/";

$persona = "mapa-" .$idpersona;
$filenombre = $persona;
$nombre_carpeta = $target_dir . $persona;



$sql="select * from mapa where idpersona=$idpersona";

$reg=mysql_query($sql);

 if ($reg){
     if (mysql_num_rows($reg)>0){
         $estado="actualizar";
     } else 
     {
         $estado="nuevo";
     }
     
 }




echo $nombre_carpeta . "/n";

if (!is_dir($nombre_carpeta)) {
    mkdir($nombre_carpeta, 0777);
} else {
    echo "Ya existe ese directorio\n";
    
}
//function test_input($data) {
//  $data = trim($data);
//  $data = stripslashes($data);
//  $data = htmlspecialchars($data);
//  return $data;
//}
//
//if (empty($_POST["name"])) {
//    $nameErr = "Name is required";
//  } else {
//    $name = test_input($_POST["name"]);
//    // check if name only contains letters and whitespace
//    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
//      $nameErr = "Only letters and white space allowed"; 
//    }
//  }


$uploadOk = 1;
// extraer extension del archivo
$imageFileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
$imagen = $imageFileType;
$mapa = $filenombre . '.' . $imageFileType . "\n";
//echo $imagen;
$target_file = $nombre_carpeta . "/" . $filenombre . "." . $imageFileType; //basename($_FILES["fileToUpload"]["name"]);
// Check if image file is a actual image or fake image
echo $target_file."/n";

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        $bandera="File is not an image.";
        
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "el archivo no exciste.";
//    $uploadOk = 1;
//    $GraSQL = FALSE;
//} else {
//    $GraSQL = TRUE;
}
// Check file size
if ($_FILES["file"]["size"] > 500000) {
    echo "Su archivo es muy grande.";
    $uploadOk = 0;
    $bandera="Su archivo es muy grande.";
}
// Allow certain file formats
if ($imageFileType != "kml") {
    echo "solo KML." . $imageFileType;
    $uploadOk = 0;
    $bandera="Solo KML";
}


// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file " . basename($nombre_carpeta . $_FILES["file"]["name"]) . " has been uploaded.";
            $ok = TRUE;
        } else {
            echo "Sorry, there was an error uploading your file.";
            $ok = FALSE;
        }


    if (($estado=="actualizar") && ($ok)) {

        $consulta = "update `mapa` set  mapa ='$mapa' where idpersona=$idpersona ";

        if (mysql_query($consulta)) {
            echo 'Actualizo con éxito <br/>Se a modificado el mapa<br/>';
        } else {
            die($consulta);
        }
    } elseif (($estado=="nuevo") && ($ok)) {


        $consulta = "INSERT INTO `mapa` (`mapa`, `idpersona`) VALUES ('$mapa',$idpersona)";
        if (mysql_query($consulta)) {
            echo 'Registrado con éxito <br> Se Agrego un nuevo mapa<br>';
        } else {
            die($consulta);
        }
    }
}