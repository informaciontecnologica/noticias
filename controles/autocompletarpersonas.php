<?php
include '../controles/tipoconexion.php';

 
 $term=$_POST["keyword"];
 $sql="SELECT * FROM `personas2` where CONCAT_WS(' ',apellido,nombre) LIKE '%$term%' order by apellido,nombre ";
// echo $sql;
 $query=mysql_query($sql);
 
 
 $json=array(); ?>
 <ul id="country-list">
     <?php
    while($country=  mysql_fetch_assoc($query)){
        ?>
    
       <li onClick="seleccion('<?php echo $country["idpersonas"]; ?>','<?php echo $country["apellido"]." ".$country["nombre"]; ?>');"><?php echo $country["apellido"]." ".$country["nombre"]; ?></li>
    <?php
       }
 
 
?>
 </ul>