<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../controles/tipoconexion.php';

 $clave=$_POST['inputPassword"'];
 $term=$_SESSION['idusuario'];
 $sql="UPDATE usuario set clave=md5($clave) where id_usuario= $term ";

 $query=mysql_query($sql);
 
 
 


if ($query){
    return true;
} else {
    return false;
}
