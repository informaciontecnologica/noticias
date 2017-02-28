<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include'../cabezera.php' ?>


    </head>
    <body>
        <header>
            <?php include '../barra.php'; ?> 
        </header> 
        <div class="container">
            <div class="row">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header"><a class="navbar-brand" href="#">Reportes</a></div>

                    <ul class="nav navbar-nav">
                        <li><a ng-click="vista(true);" >Nuevo</a></li>
                        <li><a ng-click="vista(false);" >Lista</a></li>
                        <li><a href="ayuda.php" class="glyphicon glyphicon-question-sign"></a></li>

                    </ul>
                </div>
            </div>
            <div class="row">
                <?php ?>
<!--                <form class="form-horizontal" role="form" id="perfil"  >
                    <div class="form-group text-center">  
                        <label class="control-label col-sm-2">Mail</label>
                        <div class="col-md-3 col-lg-4">
                            <input class="form-control" type="mail" ng-model="mail" name="mail" required  autofocus value="<?php echo $mail ?>" />
                            <input type="hidden" name="idusuario" ng-model="idusuario" value="<?php echo $_SESSION['idusuario'] ?>">
                                <input type="hidden" name="idpersonas" ng-model="idpersonas" value="<?php echo $idpersonas ?>">
                                    </div>
                                    </div>
                                    <div class="form-group">  
                                        <label class="control-label col-sm-2 ">Nombre</label>
                                        <div class="col-md-3 col-lg-3">
                                            <input  class="form-control" type="text" ng-model="nombre" required  name="nombre" value="<?php echo $nombre ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <label class="control-label col-sm-2 ">Apellido</label>
                                        <div class="col-md-3 col-lg-3">
                                            <input  class="form-control" type="text" ng-model="apellido" required  name="apellido" value="<?php echo $apellido ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <label class="control-label col-sm-2 ">Nacimiento</label>
                                        <div class="col-md-3 col-lg-3">
                                            <input  class="form-control" type="date" ng-model="nacimiento" required  name="nacimiento" value="<?php echo $nacimiento ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <label class="control-label col-sm-2 ">Documento</label>
                                        <div class="col-md-3 col-lg-3">
                                            <input  class="form-control" type="text" ng-model="documento" required  name="documento" value="<?php echo $documento ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <label class="control-label col-sm-2 ">Teléfono</label>
                                        <div class="col-md-3 col-lg-3">
                                            <input  class="form-control" type="tel" ng-model="telefono" required  name="telefono" value="<?php echo $telefono ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <label class="control-label col-sm-2 ">Dirección</label>
                                        <div class="col-md-3 col-lg-3">
                                            <input  class="form-control" type="tel" ng-model="direccion" required  name="direccion" value="<?php echo $direccion ?>"/>
                                        </div>
                                    </div>
                                                            <div class="form-group">  
                                                                <label class="control-label col-sm-2 ">Área</label>
                                                                <div class="col-md-3 col-lg-4">
                                                                    <input  class="form-control" type="text" ng-model="area" required size="60" name="area" value="<?php echo "'POLYGON((12 21,11 11,22 22,12 21))',0" ?>"/>
                                                                </div>
                                                            </div>
                                    <div class="form-group">  
                                        <div class="col-md-offset-2 col-md-12 col-lg-12">
                                            <input class="btn btn-default" type="submit" value="Modificar" />
                                        </div>
                                    </div>
                                    </form>-->
                                    <?php
                                    ?>

                                    </div>
                                    </div>
                                    <script>
                                        //Cuando el formulario con ID acceso se envíe...
                                        $("#perfil").on("submit", function (e) {
                                            //Evitamos que se envíe por defecto
                                            e.preventDefault();
                                            //Creamos un FormData con los datos del mismo formulario
                                            var formData = new FormData(document.getElementById("perfil"));

                                            //Llamamos a la función AJAX de jQuery
                                            $.ajax({
                                                //Definimos la URL del archivo al cual vamos a enviar los datos
                                                url: "../controles/modificacionperfil.php",
                                                //Definimos el tipo de método de envío
                                                type: "POST",
                                                //Definimos el tipo de datos que vamos a enviar y recibir
                                                dataType: "HTML",
                                                //Definimos la información que vamos a enviar
                                                data: formData,
                                                //Deshabilitamos el caché
                                                cache: false,
                                                //No especificamos el contentType
                                                contentType: false,
                                                //No permitimos que los datos pasen como un objeto
                                                processData: false,
                                                success: function (response) {
                                                    console.log(response);
                                                    alerta();
                                                }

                                            }).done(function (echo) {

                                                alerta();
                                                //Cuando recibamos respuesta, la mostramos
                                                mensaje.html(echo);
                                                mensaje.slideDown(500);
                                            });
                                        });

                                    </script>  

                                    </body>
                                    </html>