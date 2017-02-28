<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../controles/tipoconexion.php';


    $sql = "select * from provincia";

$resultados = mysql_query($sql);

if ($resultados) {
    if (mysql_num_rows($resultados) > 0) {
        while ($row = mysql_fetch_assoc($resultados)) {
            $rows[] = $row;
        }

        $pa = array("provincia" => $rows);
        $json_string = json_encode($pa);
        echo $json_string;
    }
}