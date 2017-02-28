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

$sql = "select * from registrados where idregistrador in(6,7) ";
$resultados = mysql_query($sql);

//    $data = array();

if ($resultados) {


    echo mysql_num_rows($resultados);
}

