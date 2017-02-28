
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include'../cabezera.php' ?>
        <script src="../js/claveperdio.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <?php include '../barra.php'; ?> 
        </header> 
        <div class="container">
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Desplegar navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Ingresar</a>
                </div>
                <ul class="nav navbar-nav">

                    <li><a href="ayuda.php?tag=ingresar" class="glyphicon glyphicon-question-sign"></a></li>

                </ul>
            </div>
            <div class="col-md-8  ">

                <form id="frmRestablecer"  method="post">
                    <div class="panel panel-default">
                        <div class="panel-heading"> Restaurar contraseña </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="email"> Escribe el email asociado a tu cuenta para recuperar tu contraseña </label>
                                <input type="email" id="email" class="form-control" name="email"  required/>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Recuperar contraseña" >
                            </div>
                        </div>
                    </div>
                <!--</form>value="jorge.daniel.castro.formosa@gmail.com"-->

                <div id="mensaje"></div>

            </div>
        </div>
    </body>
 
</html>