<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include'../cabezera.php' ?>
       
       
    </head>

    <body ng-app="noticias">
        <header>
            <?php include '../barra.php'; ?> 
        </header> 


        <?php
        include '../controles/tipoconexion.php';
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
        ?>
        <div class="container"  ng-controller="control">
            <div class="row">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#cc">
                            <span class="sr-only">Desplegar navegaci�n</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Imagenes</a>
                    </div>
                    <div id="cc" class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <?php if ($habilitar) { ?> <li> <a ng-click="vista(true);" >Nuevo</a></li> <?php } ?>
                            <li><a ng-click="vista(false);" >Lista</a></li>
                            <li><a href="ayuda.php#imagenes" target="_blank" class="glyphicon glyphicon-question-sign"></a></li>
                            <li><?php echo $_SESSION['idpersona'] . "-" . $_SESSION['perfil'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--******************************** Campo de observaciones del usuario-->
            <div class="row" ng-show="a">
                <form class="form-horizontal"   role="form" id="usuario" >
                    <div class="form-group ">  
                        <label class="col-md-12  col-xs-12" >Observaciones del Productor</label>
                        <div class="col-xs-12" >
                            <textarea rows="4"  <?php echo $estaadministrador ?> id="observacion" class="form-control" type="text" ng-model="formData.observacion" size="350" name="observacion" required  autofocus ></textarea>
                            <input type="hidden" id="idnoticia" name="idnoticia" ng-model="formData.idnoticia" value="{{formData.idnoticia}}" />
                        </div>
                    </div> 

                    <div class="form-group " ng-show="<?php echo!$habilitar ?>"> 
                        <div class="col-md-12  col-xs-12">
                            <input class="btn btn-primary pull-right" type="submit"  name="usuario" value="Agregar"/>
                            
                        </div>
                    </div>

                </form>


                <!--//**   Formulario de Noticias**************************-->
                <form class="form-horizontal"   role="form" id="noticias"  method="post" enctype="multipart/form-data" >
                    <div class="col-md-5 ">

                        <?php if ($habilitar) { ?>
                            <div class="form-group ">  
                                <label>Apellido y nombre</label>
                                <div>

                                    <input class="form-control col-xs-12" id="p" type="text" 
                                           ng-model="formData.persona" autocomplete="off"  name="persona" required size="50" autofocus />
                                    <div id="campo" class="col-xs-12"></div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group ">  
                            <label >Titulo</label>
                            <div >
                                <input class="form-control col-xs-3" <?php echo $estadoinput ?> type="text"  ng-model="formData.titulo" name="titulo" required size="50" autofocus  />
                            </div>

                        </div>
                        <div class="form-group ">  
                            <label >Tipo medici�n</label>
                            <div >
                                <select  name="medicion" ng-model="medicion" 
                                         ng-options="medi.id as medi.medicion for medi in mediciones track by medi.id">

                                </select>
                            </div>
                        </div>
                        <div class="form-group ">  
                            <label>Descripci�n</label>
                            <div >
                                <textarea rows="4" <?php echo $estadoinput ?>  id="encabezado" class="form-control col-xs-12" type="text" ng-model="formData.encabezado" size="150" name="encabezado" required  autofocus  >
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group ">  
                            <label class="col-xs-3" >Fecha</label>
                            <div class="col-xs-7">
                                <input class="form-control " <?php echo $estadoinput ?>  id="fecha" type="date"  ng-model="formData.fecha" name="fecha"   required   />

                            </div>
                        </div>
                        <div class="form-group "> 
                            <label class="col-xs-5" >Provincia</label> 
                            <div class="col-xs-5" >
                                <select class="form-control " 
                                        name="provincia" <?php echo $estadofile ?> 
                                        ng-model="provincia"  ng-options="pro.idprovincia as pro.provincia for pro in provincias track by pro.idprovincia ">
                                </select>   
                            </div>

                        </div>
                    </div>
                    <div class="col-md-1  "></div>
                    <div class="col-md-5  col-dm-offset-1 col-xs-12">
                        <div class="form-group ">  
                            <label >Selecci�n de Archivo</label>
                            <div class="col-xs-12" >
                                <input type="file" <?php echo $estadofile ?>  class="filestyle" data-icon="false" id="file" ng-model="formData.file"  name="file"    />
                            </div>
                        </div>
                        <div class="form-group col-xs-12">  
                            <label >Imagen</label>
                            <div class="col-xs-12">
                                <div id="image_preview"><img  id="previewing" style="width:  550px; height: 350px;" ng-src="{{imagen}}" /></div>
                            </div>
                        </div>
                        <input type="hidden" id="idpersona" name="idpersona" ng-model="formData.idpersona" value="{{formData.idpersona}}"  />
                        <input type="hidden" id="idnoticia" name="idnoticia" ng-model="formData.idnoticia" value="{{formData.idnoticia}}" />
                        <input type="hidden" id="estado" name="estado" ng-model="formData.estado" value="1" />
                        <?php if ($habilitar) { ?>
                            <div class="form-group "> 
                                <div class="col-md-12 ">
                                    <input class=" btn btn-primary pull-right" type="submit" />
                                    <button class="btn btn-default pull-right">Cancelar</button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </form>


            </div>

            <!--**********************Tabla de noticias*************--> 
            <div class="row "  ng-hide="a" ng-init="perfil == 1">
                <div class="table-responsive">
                    <div class="form-inline">
                    <div  class="input-group col-md-4"> 
                        <span class="input-group-addon">Filter</span>
                        <input class="form-control" type="text" ng-model="search"/>
                         
                    </div>
<!--                    <div  class="input-group col-md-2"> 
                        <span class="input-group-addon">Filas</span>
                        <select class="form-control " id="sel2" ng-model="pageSize">
                            <option value="10" selected>5</option>
                            <option value="10" >10</option>
                            <option value="25" >25</option>
                            <option value="50" >50</option>
                        </select> 
                    </div>-->
                </div>  
                    <hr style=""></hr>
                    <table class="table table-condensed " >
                        <div class="" ng-repeat="x in noti| filter:search | startFromGrid: currentPage * pageSize | limitTo: pageSize">
                            <div class="col-md-4">  
                                <img  class=" img-rounded "  width="250" height="250" title="Click Agrandar la imagen"
                                          ng-click="clickimagen(x.idpersona, x.imagen)"
                                          src="../controles/imagenes/mapas/{{ x.idpersona}}/{{x.imagen}}" alt="Mapa" />
                                
                           
                                <button class="col-md-9" ng-click="Editar(x.idnoticia, x.idpersona)" >
                                    <p title="click Detalle de mapa">
                                        {{x.fecha | date:'dd/MM/yyyy' }} -<span ng-if="mediciones=={id:x.idmedicion}"> {{mediciones}}</span>  -{{x.titulo}}
                                    </p> </button>
                            </div>  
                        </div>
<!--                        <thead class="thead-inverse">
                        
                            <th>Titulo</th>
                            <th>Medici�n</th>
                            <th>Mapa</th>
                            <th>Fecha</th>
                            <th>Editar</th>
                            
                        </thead >
                        <tbody ng-repeat="x in noti| filter:search | startFromGrid: currentPage * pageSize | limitTo: pageSize">

                            <tr>
                           
                                <?php if ($habilitar) {  ?>
                                <td class="col-xs-1" >
                                    {{x.nombre+" "+x.apellido}}
                                </td >
                                <?php }?>
                                <td class="col-xs-1">
                                    {{x.titulo }}
                                </td>
                                <td>
                                    {{x.idmedicion}}
                                </td>
                                <td class="col-xs-3">
                                    <img  class="img-rounded"  width="250" height="250" title="Click Agrandar la imagen"
                                          ng-click="clickimagen(x.idpersona, x.imagen)"
                                          src="../controles/imagenes/mapas/{{ x.idpersona}}/{{x.imagen}}" alt="Mapa" >
                                </td>
                                 <td>
                                    {{x.fecha}}
                                </td>
                                <td> 
                                    <a href="" ng-click="Editar(x.idnoticia, x.idpersona)" class="btn btn-primary">Editar</a>
                                </td>
                               
                            </tr>
                        </tbody>
                    </table>-->
                </div>    


                
            </div>
            <div class="row">
    
            </div>
            <div id="imagen" title="Mapa" >
                
                <span id="icon"></span>
                <span id="do"></span>
            </div>

        </div>
  <script src="../js/noticias.js" type="text/javascript"></script>
        <script>
            function seleccion(idpersona, nombre) {

                $("#idpersona").val(idpersona);
                $("#p").val(nombre);
                $("#campo").hide();
            }


            var ima = $('#imagen').dialog({
                autoOpen: false,
                resizable: true,
                height: 600,
                width: 800,
                modal: false
                
             
            });
        </script>

        <style>
            #image_preview{
                /*                position:  relative;
                                font-size: 30px;
                                top: 100px;
                                left: 100px;*/
                width: 550px;
                height: 350px;
                text-align: center;
                line-height: 180px;
                font-weight: bold;
                color: #C0C0C0;
                background-color: #FFFFFF;
                overflow: auto;
            }
            #message{
                position:absolute;
                top:120px;
                left:815px;
            }
        </style>
      
    </body>
</html>
