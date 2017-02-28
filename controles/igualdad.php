<?php
include '../controles/tipoconexion.php';

 
 $idpersona=$_POST["idpersona"];
 $fecha=$_POST["fecha"];
 
 
 $sql="SELECT * FROM noticias where idpersona= $idpersona and fecha='$fecha' ";
 $re=mysql_query($sql);
//echo $sql;
 if ($re){
     
     
     echo   "TRUE";
 } else
 {
     echo "FAlSE";
 }    
 
 