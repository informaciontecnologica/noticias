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
            <div class="row">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#cc">
                            <span class="sr-only">Desplegar navegación</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">SIG</a>
                    </div>
                    <div id="cc" class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li> <a ng-click="vista(true);" >Nuevo</a></li> 
                            <li><a ng-click="vista(false);" >Lista</a></li>
                            <li><a href="ayuda.php?tag=sig" class="glyphicon glyphicon-question-sign"></a></li>


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

            </div>
            <!--<li><?php echo $_SESSION['idpersona'] . "-" . $_SESSION['perfil'] ?></li>-->
            <div class="row " >
                <!--ng-show="!lista"-->
                <div class="bg-success">
                    <br/>
                    <form class="form-horizontal" role="form"   id="MapaSig">
                        <div class="form-group">  

                            <label  for=" ej" class="col-md-2 control-label">Mapa Regional</label>
                            <div class="col-md-5">
                                <input class="form-control " type="file" id="file" name="file" required  autofocus value="<?php echo $mapa ?>" />
                            </div>

                            <input type="hidden" name="idmapa" id="idmapa" value="<?php echo $idmapa; ?>"/>
                        </div>
                        <div class="form-group ">  
                            <label for=" ej" class="col-md-2 control-label" >Tipo medición</label>
                            <div class="col-md-5">
                                <select <?php echo $estadofile ?>   id="medicion"name="medicion" ng-model="medicion" ng-options="medi.id as medi.medicion for medi in mediciones track by medi.id">

                                </select>
                            </div>
                        </div>  

                        <div class="form-group "> 
                            <div>
                                <label for=" ej" class="col-md-2 control-label"> Fecha </label>
                            </div>
                            <div class="col-md-5">
                                <input class="" type="date" ng-model="fecha" name="fecha" />

                            </div>
                        </div>
                        <div class="form-group "> 
                            <div>
                                <label for=" ej" class="col-md-2 control-label"> Hora </label>
                            </div>
                            <div class="col-md-5">
                                <input    type="time" id="hora" value=""  step="1" name="hora" />

                            </div>
                        </div>
                        <div class="form-group "> 
                            <div>
                                <label for=" ej" class="col-md-2 control-label">  </label>
                            </div>
                            <div class="col-md-5">
                                <input class="btn btn-primary pull-right" type="submit" name="mapas" value="Agregar" />
                            </div>
                        </div>



                    </form>
                </div>   

                <div id="imagen">
                    <span id="contenido" ></span>
                </div>


                <div id="mensaje"></div>



                <div class="row" >
                    <table class="table table-striped table-condensed" >
                        <thead>
                            <caption class="text-center text-uppercase">
                                Registros de Campos
                            </caption>
                            <caption class="text-center text-primary">
                            </caption>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Tipo de Medición</th>
                                <th>Imagenes SIG Regionales</th>
                                
                            </tr>
                        </thead>
                        <!--| filter:search | startFromGrid: currentPage * pageSize | limitTo: pageSize-->
                        <tbody ng-repeat="x in sigs"  >
                            <tr>
                                <td> {{x.fecha}}
                                </td>
                                <td> {{x.hora}}
                                </td>
                                <td>
                                    <div >
                                        <select <?php echo $estadofile ?>  name="medicion" ng-model="medicion" ng-options="medi.id as medi.medicion for medi in mediciones track by medi.id">

                                        </select>
                                    </div>


                                    {{x.idmedicion}}
                                </td>
                                <td>
                                    <a href="../controles/imagenes/sig/2016/{{x.imagen}}" title="Archivo Renderizado"><span class="glyphicon glyphicon-download" aria-hidden="true">{{x.imagen}}</span></a>
                                </td>
                               
                            </tr>
                        </tbody>
                    </table>


                </div>

                <div id="dialogo">
                    <span id="texto"></span>

                </div>
            </div>
            <div id="reloj" style="font-size:20px;"></div>
            <script>


                        function startTime() {
                            today = new Date();
                            h = today.getHours();
                            m = today.getMinutes();
                            s = today.getSeconds();
                            m = checkTime(m);
                            s = checkTime(s);
                            document.getElementById('reloj').innerHTML = h + ":" + m + ":" + s;
                            t = setTimeout('startTime()', 500);
                        }

                        function checkTime(i)
                        {
                            if (i < 10) {
                                i = "0" + i;
                            }
                            return i;
                        }

                        //window.onload=function(){startTime();}
                        var d = new Date();
                        var dia = new Array(7);
                        dia[0] = "Domingo";
                        dia[1] = "Lunes";
                        dia[2] = "Martes";
                        dia[3] = "Miercoles";
                        dia[4] = "Jueves";
                        dia[5] = "Viernes";
                        dia[6] = "Sabado";
                        //                document.write("Hoy es: " + dia[d.getDay()]);
                        var aa =<?php echo $_SESSION['idpersona'] ?>;
            </script>
            <style>
                #image_preview{
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
            <script src="../js/sig.js" type="text/javascript"></script>
    </body>
</html>