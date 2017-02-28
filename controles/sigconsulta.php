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

$sql = "select * from sig";
$resultados = mysql_query($sql);
if ($resultados) {
    while ($row = mysql_fetch_assoc($resultados)) {
        $rows[] = $row;
    }

    $pa = array("sig" => $rows);
    $json_string = json_encode($pa);
    echo $json_string;
}

