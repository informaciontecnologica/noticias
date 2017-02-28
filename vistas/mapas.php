<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        include'../cabezera.php';
        include '../controles/tipoconexion.php';
        ?>


    </head>
    <body ng-app="App" ng-controller="controltabla"  >
        <header>
            <?php include '../barra.php'; ?> 
        </header> 


        <?php
        if ($_SESSION['perfil'] == 1) {
            $habilitar = true;
            $estadoinput = '';
            $estadofile = '';
            $estaadministrador = 'readonly';
        } else {
            $habilitar = false;
            $estadoinput = 'readonly';
            $estadofile = 'disabled';
            $estaadministrador = '';
        }

        $texto = "select * from mapa  where idpersona=" . $_SESSION['idpersona'];
        $resultado = mysql_query($texto);
        if (mysql_num_rows($resultado) > 0) {

            $registro = mysql_fetch_assoc($resultado);
            $mapa = $registro['mapa'];
        } else {
            $mapa = "";
        }
        ?>
        <div class="container">
                    <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#cc">
                            <span class="sr-only">Desplegar navegación</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Coordenadas</a>
                    </div>
                    <div id="cc" class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li> <a ng-click="vista(true);" >Nuevo</a></li> 
                            <li><a ng-click="vista(false);" >Lista</a></li>
                            <li><a href="ayuda.php?tag=mapas" class="glyphicon glyphicon-question-sign"></a></li>


                        </ul>
                        <ul ng-show="lista" class="nav navbar-nav col-md-2 pull-right">
                            <li>
                            <div class=" input-group ">
                                <input class="form-control " type="text" ng-model="search"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Filtrar</button></span>
                            </div></li>
                        </ul>
                    </div>
                </div>
            <div class="row">
        
            </div>
            <!--<li><?php echo $_SESSION['idpersona'] . "-" . $_SESSION['perfil'] ?></li>-->
            <div class="row bg-success" style="height: 150px;" ng-show="!lista">

                <form class="form-inline" role="form" id="mapa"  >
                    <?php if ($habilitar) { ?>
                        <div class="form-group  "> 
                           <div class="col-md-5" >
                                <label>Apellido y nombre</label>
                            
                             
                            <input class="form-control" id="p" type="text" autocomplete="off"  name="persona" required size="30" autofocus />
                            
                            <div id="campo"></div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group ">  
                        <div class="col-md-5" >
                            <label>Mapa</label>
                        
                        
                        <input class="form-control" type="file" id="file" name="file" required  autofocus value="<?php echo $mapa ?>" />
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo $_SESSION['nombre']; ?>"/>
                        <input type="hidden" name="idpersona" id="idpersona" value="<?php echo $_SESSION['idpersona']; ?>"/>
                        <input type="hidden" name="idmapa" id="idmapa" value="<?php echo $idmapa; ?>"/>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <div>
                            <label> - </label>
                        </div>
                        <input class="btn btn-primary form-control" type="submit" name="mapas" value="Agregar" />
                    </div>
                </form>
                <div id="message"></div>
            </div>





            <div class="row" ng-show="lista">
                <table class="table table-striped table-condensed" >
                    <thead>
                        <caption class="text-center text-uppercase">
                            Registros de Campos
                        </caption>
                         <tr>
                           <?php if ($habilitar){ ?><th>Productor</th> <?php }?> 
                            <th>Archivo de coordenadas KML</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <!--| filter:search | startFromGrid: currentPage * pageSize | limitTo: pageSize-->
                    <tbody ng-repeat="x in mapa"  >
                        <tr>
                            <?php if ($habilitar){ ?><td>{{x.nombre+" "+x.apellido}}</td> <?php }?> 
                            <td>
                                <a href="../controles/imagenes/mapas/mapa-{{x.idpersona}}/{{x.mapa}}" download title="Archivo de coordenadas Download">
                                    <span class="glyphicon glyphicon-download" aria-hidden="true"> {{x.mapa}}</span></a>
                            </td>
                            <td>
                                <button id="ver" ng-click="ver(x.idpersona, x.nombre+' '+x.apellido);" class="btn btn-primary">Ver</button>

                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>


            <div ng-show="puntos">
                <h4 >Puntos de Coordenadas de Productor:"{{nombreregistro}}"</h4>
                <ul>
                    <li ng-repeat="a in texto">
                        Punto({{$index + 1}}): {{ a.Punto}}
                    </li>
                </ul>
            </div>

            <div id="dialogo">
                <span id="texto"></span>

            </div>
        </div>
        <script>

                    var aa =<?php echo $_SESSION['idpersona'] ?>;


                    function seleccion(val, val2) {

                        $("#idpersona").val(val);
                        $("#nombre").val(val2.replace(" ", ""));
                        $("#p").val(val2);
                        $("#campo").hide();
                        $.detalle(val);
                    }

        </script>

        <style>
            #image_preview{
                /*                position:  relative;
                                font-size: 30px;
                                top: 100px;
                                left: 100px;*/
                width: 350px;
                height: 280px;
                text-align: center;
                line-height: 180px;
                font-weight: bold;
                color: #C0C0C0;
                background-color: #FFFFFF;
                overflow: auto;
            }
            #message{
                position:absolute;
                top:30%;
                left:50%;
            }
        </style>
        <script>


        </script>  
        <script src="../js/mapas.js" type="text/javascript"></script>
    </body>
</html>