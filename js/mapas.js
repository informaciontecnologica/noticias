/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var app = angular.module('App', []);
app.controller('controltabla', function ($scope, $http) {
           $scope.lista = true;
 $scope.puntos=false; 

        $scope.mapas = function (aa) {
        $http({
                url: '../controles/Listamapas.php',
                method: "GET",
               params:{id:aa}
               
            }).then(function (response) {
              $scope.mapa = response.data.mapas;
              console.log(response.data);
              
           });
        };
        $scope.mapas(aa);
        $scope.vista = function (valor){
            $scope.lista = !valor;
            $scope.puntos=false;
                $scope.texto = "";
                if ($scope.lista){
                    $scope.mapas(id);
                    }
        };
        
        $scope.ver = function(i, nombre){
                $scope.puntos=true;
                $scope.nombreregistro=nombre;
                console.log(i + " " + nombre);
                $http({
                        url: '../vistas/a.php',
                        method: "GET",
                        params:{id:i}
                }).then(function (response) {
                    $scope.texto = "";
                    $scope.texto = response.data.coordenadas;
                        console.log(response.data);
                });
        };
       
});
      


$(document).ready(function () {
//Cuando el formulario con ID acceso se envíe...
$("#mapa").on("submit", function (e) {
//Evitamos que se envíe por defecto
e.preventDefault();
        //Creamos un FormData con los datos del mismo formulario
        var formData = new FormData(document.getElementById("mapa"));
        //Llamamos a la función AJAX de jQuery
        $.ajax({
        //Definimos la URL del archivo al cual vamos a enviar los datos
        url: "../controles/mapas.php",
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
                }

        }).done(function (echo) {
              ima.dialog('option', 'title', 'Actualización de Coordenadas');

            ima.dialog({width: 300, height: 200});
            ima.text('Se actualizo con exito');
            ima.on("dialogbeforeclose", function (event, ui) {
                location.reload();
            });
            ima.dialog('open');
        
        });
        });
        
        
        var ima = $('#dialogo').dialog({
                autoOpen: false,
                resizable: true,
                height: 200,
                width: 300,
                modal: false,
                buttons: {
                    "Cerrar": function () {
                        $(this).dialog("close");
                    }
                } 
            });   
        
        
        
        
        
        
        
//  $('#fecha').val(new Date().toDateInputValue());
        $("#p").keyup(function () {
$.ajax({
type: "POST",
        url: '../controles/autocompletarpersonas.php',
        data: 'keyword=' + $(this).val(),
        beforeSend: function () {
//                                                $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function (data) {
        $("#campo").show();
                $("#campo").html(data);
                $("#p").css("background", "#FFF");
        }
});
        });
        $.ver = function (id, mapa) {
//    console.log( id+" "+mapa );
//    alert( "Handler for .click() called." );
        };
        $.detalle = function (idpersona) {
        $.ajax({
        type: "POST",
                url: '../controles/buscarmapa.php',
                data: 'idpersona=' + idpersona,
                // Formato de datos que se espera en la respuesta
                dataType: "json",
                beforeSend: function () {
//                                                $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function (data) {
                $("#mmapa").text("");
                        $("#mmapa").text(data.mapas.mapa);
                }
        });
        };
        $.myFunction = function(file, id) {
        $.ajax({
        type: "POST",
                url: '../vista/a.php',
                data:{'idpersona': id, 'file':file},
                // Formato de datos que se espera en la respuesta

                beforeSend: function () {
//                                                $("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function (data) {
                $("#texto").text("");
                        $("#texto").html(data);
                }
        });
        };
// Function to preview image after validation
        $(function () {
        $("#file").change(function () {
        $("#message").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["application/vnd.google-earth.kml+xml"];
                if (!((imagefile == match[0])))
        {

//              $('#previewing').attr('src', 'noimage.png');application/vnd.google-earth.kml+xml
        $("#message").html("<p id='error'>Seleccione una solo tipo de archivo </p><span id='error_message'>Solo KML permitido</span>");
                return false;
        } else
        {
//                $("#message").html(imagefile );
        }
        });
        });
});