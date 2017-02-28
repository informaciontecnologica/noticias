<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$url=  $_SERVER['SERVER_NAME'];
if ($url=='localhost'){
$host="localhost";
$user="root";
$clave="";
$base="sada";
} else {
$host="localhost";
$user="informac_admin";
$clave="qwedcxz123";
$base="sada"; }

$link = mysql_connect("$host", "$user", "$clave")
    or die('No se pudo conectar: ' . mysql_error());
//echo 'Connected successfully';
mysql_select_db("$base") or die('No se pudo seleccionar la base de datos');
// base de datos :informac_sada