<?php
// verficiar si no existe el archivo o directorio y poner una bandera por que pude tener cargado en la base sin el file.-


$id=$_GET['id'];
$file="../controles/imagenes/mapas/mapa-$id/mapa-$id.kml";
//echo $file;
  $m = array();
function kmlToArray($filePath)
{
  if (file_exists($filePath)) {
        
        $xml = simplexml_load_file($filePath);
        $aa=array();
        $value    = (string)$xml->Document->Placemark->Polygon->outerBoundaryIs->LinearRing->coordinates;
        $values   = explode(" ", trim($value));
        $coords   = array();
        foreach($values as  $value) {   
            $value = trim(preg_replace('/\t+/', '', $value));
            $args     = explode(",", $value);
            
            array_push($coords,$args[0].", ".$args[1]);
        }
      
         foreach ($coords as $key => $value) {
              $m[]=array("Punto"=>"$value");
             
//            echo "Punto:".$key . "($value)";
  }
//  print_r($m);
  $da=array("coordenadas"=>$m);
       echo json_encode($da);
        
        
    } else {
        return 'Error : Failed to open the file';
    }
//    return $coords;
}

$ca=kmlToArray($file);

//foreach ($ca as $key => $value) {
//    $punto[]=$ca;
//    
//}

//$da=array("coordenadas"=>$m);

//echo json_encode($m);    
