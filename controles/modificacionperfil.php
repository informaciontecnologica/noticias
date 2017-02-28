<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start(); 
require('tipoconexion.php');

//Obtenemos los datos del formulario de registro
                     $mail=$_POST['mail'] ;
                     if (empty($_POST['idpersonas'])){  
                         $idpersonas=$_POST['idpersonas'] ; 
                         
                     } else
                     {
                         $idpersonas=$_POST['idpersonas'] ; 
                     }
                         
                     $nombre=$_POST['nombre'];
                     $apellido=$_POST['apellido'] ;
                     $telefono=$_POST['telefono'] ;
                     $direccion=$_POST['direccion'] ;
                     $documento=$_POST['documento'] ;
                     $idusuario=$_POST['idusuario'] ;
                     $nacimiento=$_POST['nacimiento'] ;
//                     $idciudad=$_POST['idciudad'] ;
//                     $idprovincia=$_POST['idprovincia'] ;
                         
                     
                     




//"a";// "b";//"c";//

//Filtro anti-XSS
                      $mail=htmlspecialchars(mysql_real_escape_string( $mail)) ;
//                     $idpersonas=htmlspecialchars(mysql_real_escape_string( $idpersonas));
                     $nombre=htmlspecialchars(mysql_real_escape_string( $nombre));
                     $apellido=htmlspecialchars(mysql_real_escape_string( $apellido));
                     $telefono=htmlspecialchars(mysql_real_escape_string( $telefono));
                     $direccion=htmlspecialchars(mysql_real_escape_string( $direccion)) ;
                     $documento=htmlspecialchars(mysql_real_escape_string( $documento));
                     $documento=htmlspecialchars(mysql_real_escape_string( $documento));



//Escribimos la consulta necesaria
$consultaUsuarios = "SELECT * FROM `personas2` where documento='$documento'";

//Obtenemos los resultados
$resultadoConsultaUsuarios = mysql_query($consultaUsuarios) or die(mysql_error());
$datosConsultaUsuarios = mysql_fetch_array($resultadoConsultaUsuarios);
$documento1 = $datosConsultaUsuarios['documento'];

//Si el input de usuario o contraseña está vacío, mostramos un mensaje de error
//Si el valor del input del usuario es igual a alguno que ya exista, mostramos un mensaje de error
if(empty($_POST['idpersonas'])) {
    
 
	$consulta = "INSERT INTO `personas2` (nombre,apellido,nacimiento,mail,telefono,direccion,documento,idusuario)
	VALUES ('$nombre','$apellido','$nacimiento','$mail','$telefono','$direccion',$documento,$idusuario)";
        
//	echo $consulta;
	//Si los datos se introducen correctamente, mostramos los datos
	//Sino, mostramos un mensaje de error, GeomFromText($area)
	if(mysql_query( $consulta)) {
            $ok=TRUE;
		die('Registrado con éxito <br>'.
                            'Se a modificado el Perfil<br>');

	} else {
            $ok=FALSE;
		die($consulta);
	}
} else {
	$consulta = "update `personas2` 
            set nombre ='$nombre' ,
            apellido='$apellido' ,
            nacimiento= '$nacimiento',
            mail='$mail' ,
            telefono= '$telefono',
            direccion= '$direccion',
            documento=$documento 
            where idpersonas=$idpersonas ";
	

	//Si los datos se introducen correctamente, mostramos los datos
	//Sino, mostramos un mensaje de error, GeomFromText($area)
	if(mysql_query( $consulta)) {
            $ok=TRUE;
		die(   'Registrado con éxito <br>'.
                     'Se a modificado el Perfil<br>');

	} else {
            $ok=FALSE;
		die($consulta);
	}
    
}
if ($ok){
$_SESSION['nombre']=$nombre;
}


//if (empty($idpersonas)){
//	$consulta = "select * from personas where idusuario=$idusuario";
//        
////	echo $consulta;
//	//Si los datos se introducen correctamente, mostramos los datos
//	//Sino, mostramos un mensaje de error, GeomFromText($area)
//        
//        
//	if(mysql_query( $consulta)) {
//            $resultados = mysql_fetch_assoc($consulta);
//              if ($resultados['idpersona']){
//                  $_SESSION['idpersona']=15412;//$resultados['idpersona'];
//                  echo $resultados['idpersona'];
//              }
//              
//        }
//} else 
//{
//    echo "asdfasdas";
//   
//} 
