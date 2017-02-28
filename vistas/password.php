<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include'../cabezera.php' ?>



    </head>
    <body  >
        <header>
            <?php include '../barra.php'; ?> 
            <script src="../bootstrap-validator-master/dist/validator.min.js" type="text/javascript"></script>
            <script src="../bootstrap-validator-master/js/validator.js" type="text/javascript"></script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" type="text/cs"/>


        </header> 

        <div class="container">
            <div class="row">

                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header"><a class="navbar-brand" href="#">Password</a></div>
                     <ul class="nav navbar-nav">
                        
                        <li><a href="ayuda.php?tag=password" class="glyphicon glyphicon-question-sign"></a></li>

                    </ul>
                </div>
                
                
                
                <form id="Cambiopassword" data-toggle="validator" class="form-horizontal" role="form" >
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-sm-2 ">Clave</label>
                        <div class="col-md-4">
                            <input type="password" class="form-control" id="clave" name="clave" placeholder="Clave Actual..."  
                                   data-minlength="1" required/>
                            <span class="help-block">Mínimo un (1) digitos</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-sm-2 ">Nueva clave</label>
                        <div class="col-md-4">
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Digite Nueva clave"  
                                   data-minlength="6" required/>
                            <span class="help-block">Mínimo de seis (6) digitos</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputConfirm" class="control-label col-sm-2 ">Confirmar Clave</label>
                        <div class="col-md-4">     
                            <input type="password" class="form-control" id="inputConfirm" placeholder="Confirme su clave..." 
                                   data-match="#inputPassword" data-match-error="Atención! la clave no es igual" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </div>
                </form>



                <div id="dialog-confirm" title="Información">
                    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
                        <span id="mensaje"></span> </p>
                </div>
                <span id="mensaje1"></span> 


            </div>
</div>
            <script>
                var formData = new FormData(document.getElementById("Cambiopassword"));
                $(function () {
                    x = $('#dialog-confirm').dialog({
                        autoOpen: false,
                        resizable: false,
                        height: "auto",
                        width: 400,
                        modal: false,
                        buttons: {
                            "Aceptar": function () {
                                BuscarPassword();
                                $(this).dialog("close");
                            },
                            "Cancelar": function () {
                                $(this).dialog("close");
                            }
                        }
                    });
                    //Cuando el formulario con ID acceso se envíe...
                    $("#Cambiopassword").on("submit", function (e) {
                        //Evitamos que se envíe por defecto
                        e.preventDefault();
                        //Creamos un FormData con los datos del mismo formulario
                        $('#mensaje').html("Esta seguro de Cambiar su Clave?");
                        x.dialog("open");


                    });


                    function BuscarPassword() {

                        //Llamamos a la función AJAX de jQuery       
                        $.ajax({
                            //Definimos la URL del archivo al cual vamos a enviar los datos
                            url: "../controles/buscarpassword.php",
                            //Definimos el tipo de método de envío
                            type: "POST",
                            //Definimos el tipo de datos que vamos a enviar y recibir
                            dataType: "html",
                            //Definimos la información que vamos a enviar
                            data: formData,
                            //Deshabilitamos el caché
                            cache: false,
                            //No especificamos el contentType
                            contentType: false,
                            //No permitimos que los datos pasen como un objeto
                            processData: false,
                            success: function (echo) {

                                if (echo) {
                                    $('#mensaje1').html("La clave no corresponde");
                                    exit();
                                } else
                                {

                                    if (CambiarPassword()) {
                                        $('#mensaje1').html(echo);
                                    }

                                }
                            }
                        });
                    }
                    ;
                    function CambiarPassword() {

                        //Llamamos a la función AJAX de jQuery       
                        $.ajax({
                            //Definimos la URL del archivo al cual vamos a enviar los datos
                            url: "../controles/cambiarpassword.php",
                            //Definimos el tipo de método de envío
                            type: "POST",
                            //Definimos el tipo de datos que vamos a enviar y recibir
                            dataType: "html",
                            //Definimos la información que vamos a enviar
                            data: formData,
                            //Deshabilitamos el caché
                            cache: false,
                            //No especificamos el contentType
                            contentType: false,
                            //No permitimos que los datos pasen como un objeto
                            processData: false,
                            success: function (echo) {
                                console.log(echo);
                                if (!echo) {
                                    $('#mensaje1').html("no pudo concretarse");

                                } else {
                                    $('#mensaje1').html("Existo");
                                }

                            }


                        });





                    }
                    ;

                });
            </script>  

    </body>
</html>