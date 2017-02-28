
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
            <div class="col-md-12  col-lg-offset-3">
                <?php
                if (!isset($_SESSION['nombre'])) {
                    ?>

                    
                    <form class="form-horizontal" role="form"  action="../controles/sess.php" method="post">
                        <div class="form-group  ">  
                            <label class=" col-xs-12 " >Mail</label>
                            <div class="col-xs-12 col-md-4 ">
                                <input class="form-control" type="mail" ng-model="mail" name="mail" required  maxlength="45" autofocus/>
                            </div>
                        </div>
                        <div class="form-group">  
                            <label class="col-xs-12 col-md-14 " >Clave</label>
                            <div class="col-xs-6 col-md-2 ">
                                <input  class="form-control" type="password" ng-model="password" required  name="password" />
                            </div>
                        </div>
                        <div class="form-group">  
                            <div class="col-xs-3  col-md-4 ">
                                <a href="claveperdio.php">Perdio su Clave?</a>
                            </div>
                        </div>
                        <div class="form-group">  
                            <div class="col-xs-3  col-md-4 ">
                                <input class="btn btn-default pull-right"  type="submit" value=" Login " />
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ?>

            </div>
        </div>
    </body>
</html>