<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../controles/tipoconexion.php';
$a = array('3', '4','5');
$ses=$_SESSION['perfil'];
$idnoticia=$_POST['idnoticia'];
$observacion=$_POST['observacion'];

if (in_array($ses, $a)) {
    $sql = "update noticias set observacion='$observacion' where idnoticia=$idnoticia";
    $resultados = mysql_query($sql);
   print_r($sql);
} 