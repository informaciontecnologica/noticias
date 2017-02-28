<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../controles/tipoconexion.php';

 
 $term=$_SESSION['idusuario'];
 $sql="SELECT * FROM usuario where id_usuario= $term ";

 $query=mysql_query($sql);
 
 $mapas=  mysql_fetch_assoc($query);
 


if ($mapas['clave']== md5($_POST['clave'])){
    return true;
} else {
    return false;
}
//
//$da=array("usuario"=>$mapas);
//echo json_encode($da);    