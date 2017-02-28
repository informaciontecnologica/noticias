<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of listausuario
 *
 * @author xpc
 */
include '../controles/tipoconexion.php';


//
//$postdata = file_get_contents("php://input");
//$request = json_decode($postdata);
//$idperfil = $request->idperfil;
//$idusuario = $request->idusuario;
$mail=$_POST['mail'];
$clave=md5($_POST['clave']);
$fecha=date("Y-m-d"); 
$idperfil=5;

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$nacimiento=$_POST['nacimiento'];
$documento=$_POST['documento'];
$idregistrador=$_POST['idregistrador'];
//Filtro anti-XSS
                      $mail=htmlspecialchars(mysql_real_escape_string( $mail)) ;
                     $nombre=htmlspecialchars(mysql_real_escape_string( $nombre));
                     $apellido=htmlspecialchars(mysql_real_escape_string( $apellido));
                     $telefono=htmlspecialchars(mysql_real_escape_string( $telefono));
                     $direccion=htmlspecialchars(mysql_real_escape_string( $direccion)) ;
                     $documento=htmlspecialchars(mysql_real_escape_string( $documento));

//Escribimos la consulta necesaria
$consultaUsuarios = "SELECT * FROM `personas2` where documento='$documento'";

//Obtenemos los resultados
$resultadoConsultaUsuarios = mysql_query($consultaUsuarios) or die(mysql_error());
$datosConsultaUsuarios = mysql_fetch_array($resultadoConsultaUsuarios);
$documento1 = $datosConsultaUsuarios['documento'];



if(mysql_num_rows($resultadoConsultaUsuarios)==0) {
    
        $sql = "insert into usuario (mail,clave,fecha,id_perfil) values ('$mail','$clave','$fecha',$idperfil)";
        $resultados = mysql_query($sql);

        if ($resultados) {

        $idusuario=mysql_insert_id();
        $consulta = "INSERT INTO `personas2` (nombre,apellido,nacimiento,mail,telefono,direccion,documento,idusuario)
	VALUES ('$nombre','$apellido','$nacimiento','$mail','$telefono','$direccion',$documento,$idusuario)";
        if(mysql_query( $consulta)) {
            
	 	
         $idpersona=mysql_insert_id();
            $registra="insert into registrados (idpersona,idregistrador) values ($idpersona,$idregistrador)";
           if (mysql_query($registra)){
           echo "completo";
           }
	} else {
            $ok=FALSE;
		die($consulta);
        }
    
} else {

}

	
} else {
    echo "Existedocu";
}
    
                


