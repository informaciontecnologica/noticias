<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         require_once 'personas.php';
        $descricion=$_GET['descripcion'];
        $nombre=$_GET['nombre'];
        $persona = new Personaje("$nombre", "$descricion");
        $persona->guardar();
        echo $persona->getNombre() . ' se ha guardado correctamente con el id: ' . $persona->getId();
?>
    </body>
</html>
