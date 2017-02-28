<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../controles/tipoconexion.php';
$a = array('1', '2');
$ses=$_SESSION['perfil'];

if (in_array($ses, $a)) {
    $sql = "select * from noticias n left join personas2 p on p.idpersonas=n.idpersona order by fecha desc";
} else {
    $sql = "select * from noticias n left join personas2 p on p.idpersonas=n.idpersona where n.idpersona=".$_SESSION['idpersona']." order by fecha desc";
}

$resultados = mysql_query($sql);


if ($resultados) {
    if (mysql_num_rows($resultados) > 0) {
        while ($row = mysql_fetch_assoc($resultados)) {
            $rows[] = $row;
        }

        $pa = array("noticias" => $rows);
        $json_string = json_encode($pa);
        echo $json_string;
    }
}