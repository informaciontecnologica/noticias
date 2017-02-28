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


//Escribimos la consulta necesaria
$consultaUsuarios = "SELECT * FROM `personas2` where mail='$mail'";

//Obtenemos los resultados
$resultadoConsultaUsuarios = mysql_query($consultaUsuarios) or die(mysql_error());
$datosConsultaUsuarios = mysql_fetch_array($resultadoConsultaUsuarios);
$mail = $datosConsultaUsuarios['mail'];



if(mysql_num_rows($resultadoConsultaUsuarios)>0) {
          
echo $mail;

        

} else {
    echo "ok";
}
    
                


