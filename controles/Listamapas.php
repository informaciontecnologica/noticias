<?php
session_start();
include '../controles/tipoconexion.php';

$a = array('1', '2');
$perfil=$_SESSION['perfil'];
 $idpersona=$_GET['id'];
if (in_array($perfil, $a)) {    
    $sql="SELECT * FROM mapa m left join personas2 p on p.idpersonas=m.idpersona "; 
} else {
$sql="SELECT * FROM mapa m left join personas2 p on p.idpersonas=m.idpersona where p.idpersonas=$idpersona";
}
 $query=mysql_query($sql);
 
 while ($row = mysql_fetch_assoc($query)) {
       $mapas[]=$row;   
}
 
 


$da=array("mapas"=>$mapas);
echo json_encode($da);    