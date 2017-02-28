<?php
include '../controles/tipoconexion.php';

 
 $term=$_POST["idpersona"];
 $sql="SELECT * FROM mapa where idpersona= $term ";

 $query=mysql_query($sql);
 
 $mapas=  mysql_fetch_assoc($query);
 
//$mapas[]=array($mapas['idmapa'],$mapas['mapa']); 

$da=array("mapas"=>$mapas);
echo json_encode($da);         