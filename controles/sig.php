<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../controles/tipoconexion.php';


$target_dir = "imagenes/sig";

$idmedicion=$_POST['medicion'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$horas= substr($hora, 0,2);
$nombre_carpeta=$target_dir."/".date("Y");
if (!is_dir($nombre_carpeta)) {
    mkdir($nombre_carpeta, 0777);
} 
    echo "Ya existe ese directorio\n";
// extraer extension del archivo
    $imageFileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
  
    $target_file = $nombre_carpeta . "/" . $fecha."-".$horas."-".$_FILES["file"]["name"];
    echo $target_file;
    $imagen=$fecha."-".$horas."-".$_FILES["file"]["name"];

$ok=1 ;
 $uploadOk = 1;
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

//if ($imageFileType != "jpg" && $imageFileType != "img" && $imageFileType != "jpeg" && $imageFileType != "gif") {
//    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//    $uploadOk = 0;
//}

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
        $idsig= $_POST['idsig'];
        $consulta = "update `sig` 
            set ,fecha,hora,imagen
            idmedicion ='$idmedicion' ,
            imagen='$imagen' ,
            fecha= '$fecha',
            hora='$hora'
             where idnoticia=$idsig";


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

        $consulta = "INSERT INTO `sig` (idmedicion,fecha,hora,imagen) "
                ."VALUES ($idmedicion,'$fecha','$hora','$imagen')";

	
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