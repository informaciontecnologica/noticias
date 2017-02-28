<?php
//Iniciamos la sesión
//Pedimos el archivo que controla la duración de las sesiones
require('../controles/sesiones.php');
?>
<!doctype html>
<html>
    <head>
        <?php include '../cabezera.php'; ?>
    </head>
    <body>
        <header>

        </header>
        <?php include '../barra.php'; ?> 
        <div class=" container">
            <div class="row">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header"><a class="navbar-brand" href="#">Registrarse</a></div>

                    <ul class="nav navbar-nav">
                      
                   <li><a ng-click="vista(false);" >Lista</a></li>-->
                  <li><a href="ayuda.php?tag=registrarse" class="glyphicon glyphicon-question-sign"></a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <form  method="POST" id="registro" action="" accept-charset="utf-8" class="form-horizontal ">

                    <div class="form-group text-center">
                        <label class="control-label col-sm-2">Mail</label>
                        <div class="col-md-4 col-mg-3">
                            <input type="email" class="form-control" required name="mailRegistro" class="registro" id="mailRegistro" placeholder="Mail" autocomplete="off" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label class="control-label col-sm-2">Clave</label>
                        <div class="col-md-3 col-mg-3">
                            <input type="password" class="form-control" required name="passRegistro" class="registro" id="passRegistro" placeholder="Contraseña" autocomplete="off" maxlength="16">
                        </div></div>
                    <div class="form-group">  
                        <div class="col-md-offset-2 col-md-12 col-lg-12">
                            <input type="submit" class="btn btn-primary" name="registro" class="boton-principal" value="Registrarse">
                        </div>
                    </div>
                </form>
                <div id="mensaje"></div>
            </div>
        </div>
        <script>
       
            //Guardamos el controlador del div con ID mensaje en una variable
            var mensaje = $("#mensaje");
            //Ocultamos el contenedor
            mensaje.hide();

            //Cuando el formulario con ID acceso se envíe...
            $("#registro").on("submit", function (e) {
                //Evitamos que se envíe por defecto

                e.preventDefault();
                //Creamos un FormData con los datos del mismo formulario
                var formData = new FormData(document.getElementById("registro"));
                //Llamamos a la función AJAX de jQuery
                $.ajax({
                    //Definimos la URL del archivo al cual vamos a enviar los datos
                    url: "../controles/registro.php",
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
                    success: function (data) {

                        console.log(data);
                        $('#registro').hide();
                        $("#message").html(data);
                    }

                }).done(function (data) {
                    //Cuando recibamos respuesta, la mostramos
                    mensaje.html(data);
                    mensaje.slideDown(500);
                });
            });



        </script>
    </body>
</html>