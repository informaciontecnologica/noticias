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



$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$idperfil = $request->idperfil;
$idusuario = $request->idusuario;

// ************* la vairable envidad del select es un objeto se caputa $idperfil->id   -------------

$sql = "update  usuario set id_perfil=$idperfil->id where id_usuario=$idusuario";
$resultados = mysql_query($sql);

//    $data = array();

if ($resultados) {
    echo "ok";
} else {
    echo "error";
}
echo $sql;
