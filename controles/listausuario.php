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

$sql = "select u.mail,u.id_perfil,p.idpersonas,p.nombre,p.apellido,p.direccion,p.telefono,p.nacimiento,p.documento  from usuario u left join personas2 p on u.id_usuario=p.idusuario";
$resultados = mysql_query($sql);

//    $data = array();

if ($resultados) {
    while ($row = mysql_fetch_assoc($resultados)) {
        $rows[] = $row;
    }

    $pa = array("usuarios" => $rows);
    $json_string = json_encode($pa);
    echo $json_string;
}

