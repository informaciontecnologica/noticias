<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo $_POST["nombre"]."-".$_POST["mail"]."-".$_POST["consulta"];

if (isset($_POST["nombre"]))
{
$to = "miranda.federico@inta.gob.ar";
$de = $_POST['mail'];
$nombre = $_POST["nombre"];
$subject = "Consulta de sistema de mapas por $nombre";
$mensaje = $_POST["consulta"];
$headers = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: {$nombre} <{$de}>";
$headers[] = "Bcc: Administrador <info@informaciontecn.com.ar>";
$headers[] = "Reply-To: {$nombre} <{$de}>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/" . phpversion();

$result = mail($to, $subject, $mensaje, implode("\r\n", $headers));
if ($result) {
   echo $result;
} else {
//    return false;
}
 echo $result;
}
print_r($headers);