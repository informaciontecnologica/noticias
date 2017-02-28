<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

/* Establecemos que las paginas no pueden ser cacheadas */
header("Expires: Tue, 01 Jul 2019 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('America/Argentina/Buenos_Aires');

function logOut() {
    session_unset();
    session_destroy();
    session_start();
    session_regenerate_id(true);
}


echo "
 <meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />
        <meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
        <link href=\"../css/noticias.css\" rel=\"stylesheet\" type=\"text/css\"/>
        <title>Sistema de Monitoreo de los Vegetales</title>

        <script src=\"../jquery/jquery-2.1.3.js\" type=\"text/javascript\"></script>
        <script src=\"../jquery/jquery-ui-1.12.1.custom/jquery-ui.js\"></script>
        <link href=\"../jquery/jquery-ui-1.12.1.custom/jquery-ui.css\" rel=\"stylesheet\" type=\"text/css\"/>
         <link href=\"../jquery/jquery-ui-1.12.1.custom/jquery-ui.theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
        
  ";     
// link de Bootstrap 
 echo " <script src=\"../bootstrap-3.3.5-dist/js/bootstrap.min.js\" type=\"text/javascript\"></script>
        <link href=\"../bootstrap-3.3.5-dist/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
       <!-- ideally at the bottom of the page -->
<!-- also works in the <head> -->

<script src=\"../jquery/angular.min.js\" type=\"text/javascript\"></script>

   <script src=\"../bootstrap-validator-master/dist/validator.min.js\" type=\"text/javascript\"></script>

            <script src=\"../bootstrap-validator-master/js/validator.js\" type=\"text/javascript\"></script>
        ";

