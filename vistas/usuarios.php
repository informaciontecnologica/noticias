<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include'../cabezera.php' ?>

        <script src="../js/usuarios.js" ></script> 

    </head>
    <body ng-app="myApp" ng-controller="cus">
        <header>
            <?php include '../barra.php'; ?> 

        </header> 
        <?php $arra = array(1, 2, 6, 7) ?>
        <div class="container">

            <div class="row">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header"><a class="navbar-brand" href="#">Usuarios</a></div>

                    <ul class="nav navbar-nav">
                        <?php if (in_array($_SESSION['idpersona'], $arra)) { ?>"  <li><a ng-click="vista('nuevo')" >Nuevo</a></li><?php } ?>
                        <li><a ng-click="vista('lista');" >Lista</a></li>
                        <li><a href="ayuda.php?tag=usuario"  <a class="glyphicon glyphicon-question-sign"></a></li>

                    </ul>
                </div>
            </div>
            <?php // echo md5('federico'); ?>
            <div class="row" ng-show="nuevo">
                <form class="form-horizontal" role="form" id="usuario" data-target="verify" >
                    <strong class="text-info">Registrados por Federico Miranda:<?php include '../controles/registradomiranda.php'; ?></strong>
                    <div class="form-group">  
                        <div class="col-md-5 col-xs-12">
                            <label >Mail - Usuario</label>
                            <input class="form-control" type="email" ng-model="mail" id="mail" name="mail" required  autofocus  />

                            <input type="hidden" name="idregistrador" ng-model="idregistrador" value="<?php echo $_SESSION['idpersona'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">  

                        <div class="col-md-3 col-lg-3 col-xs-5">
                            <label >Clave</label>
                            <input   class="form-control" type="password"  required  name="clave" />
                        </div>
                    </div>

                    <div class="form-group">  

                        <div class="col-md-3 col-lg-3 col-xs-5">
                            <label >Nombre</label>
                            <input   class="form-control" type="text"  required  name="nombre" id="nombre" />
                        </div>
                    </div>
                    <div class="form-group">  

                        <div class="col-md-3 col-lg-3 col-xs-5">
                            <label >Apellido</label>
                            <input   class="form-control" type="text"  required id="apellido"  name="apellido"  />
                        </div>
                    </div>
                    <div class="form-group">  

                        <div class="col-md-3 col-lg-3 col-xs-5"> 
                            <label>Nacimiento</label>
                            <input   class="form-control" type="date" required  name="nacimiento"  />
                        </div>
                    </div>
                    <div class="form-group">  

                        <div class="col-md-3 col-lg-3 col-xs-5"> 
                            <label >Documento</label>
                            <input   class="form-control" type="number" required  name="documento"  />
                        </div>
                    </div>
                    <div class="form-group">  

                        <div class="col-md-3 col-lg-3 col-xs-5">
                            <label >Teléfono</label>
                            <input   class="form-control" type="tel" required  name="telefono" />
                        </div>
                    </div>
                    <div class="form-group">  
                        <div class="col-md-5 col-lg-3 col-xs-12"> 
                            <label >Dirección</label>
                            <input   class="form-control" type="text"  required  name="direccion" />
                        </div>
                    </div>

                    <input class=" btn btn-primary" type="submit"  />
                </form>
            </div>


            <div class="row" ng-show="lista" >
                <table   class="table table-striped">
                    <thead>
                        <tr>
                            <th >Nombre</th>

                            <th >Mail</th>

                        </tr>
                    </thead>  
                    <tbody>
                        <tr ng-repeat="x in usuario">
                            <td ><span ng-if="x.nombre!=null">
                                       {{x.nombre + " " + x.apellido}}</span>
                                <span class="text-info" ng-if="x.nombre==null">
                                       Falta Cargar Perfil</span></td>

                            <td >{{x.mail}}</td>
                            <td ></td>

                            <td ><button ng-click="vistausuario(x.idpersonas);" class="btn btn-primary"><span>Editar</span></button></td>
                            <td>
                                <select ng-init="perfila={id:x.id_perfil}" ng-model="perfila"  ng-change="update(perfila, x.id_usuario);"  
                                        ng-options="item as item.label for item in perfiles track by item.id">  </select>
                            <!--lo enviado es un objeto , se trabaja coomo objeto , el ng-init lee el valor de repeta prinicpal-->

                            </td>
                            
                        </tr>
                    </tbody> 
                </table>
                {{id}}
            </div>

            <div  class="panel panel-info" ng-show="detalle">
                <div class="panel-heading text-center" >Detalle del Productor</div>
                <ul class="list-group ">
                    <li class="list-group-item">
                        Nombre: {{persona}}
                    </li>
                    <li class="list-group-item">
                        Direccion: {{direccion}}
                    </li>
                    <li class="list-group-item">
                        Telefono: {{telefono}}
                    </li>
                    <li class="list-group-item">
                        Mail: {{mail}}
                    </li>
                    <li class="list-group-item">
                        Nacimiento: {{nacimiento}}
                    </li>
                    <li class="list-group-item">
                        Documento: {{documento}}
                    </li>

                </ul>
            </div>
        </div>


        <div id="dialogo"></div>

    </body>
</html>
<!--miranda.federico@inta.gob.ar            -->