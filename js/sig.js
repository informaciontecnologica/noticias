/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var app = angular.module('App', []);
app.controller('controltabla', function ($scope, $http) {
    $scope.lista = true;
    $scope.puntos = false;
    $scope.medicion = {id: 1};
    $scope.fecha = new Date();
//var d = new Date();
//$scope.times=d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() ;
//$scope.hora=new Date();

    $scope.mediciones = [{
            id: '1',
            medicion: 'Indice verde'
        },
        {id: '2', medicion: 'Fotosintesis'}
    ];

    $scope.sig = function () {
        $http({
            url: '../controles/sigconsulta.php',
            method: "POST",
            data: {as: 's'}
        }).then(function (response) {
            $scope.sigs = response.data.sig;
            console.log(response);


        });
    };
    $scope.sig();

//        $scope.vista = function (valor){
//            $scope.lista = !valor;
//                $scope.texto = "";
//                if ($scope.lista){
//                    $scope.mapas(id);
//                    }
//        };

//        $scope.ver = function(i, d){
//                $scope.puntos=!$scope.puntos;
//                console.log(i + " " + d);
//                $http({
//                        url: '../vistas/a.php',
//                        method: "GET",
//                        params:{id:2}
//                }).then(function (response) {
//                    $scope.texto = "";
//                    $scope.texto = response.data.coordenadas;
//                        console.log(response.data);
//                });
//        };

});



$(document).ready(function () {
    var d = new Date();
    d.getHours();
    d.getMinutes();
    d.getSeconds();

    var hours = d.getHours();
    var minutes = d.getMinutes();
    $("#hora").val(d.getHours() + ":00");



//Cuando el formulario con ID acceso se envíe...
    $("#MapaSig").on("submit", function (e) {
//Evitamos que se envíe por defecto
        e.preventDefault();
        //Creamos un FormData con los datos del mismo formulario
        var formData = new FormData(document.getElementById("MapaSig"));
        //Llamamos a la función AJAX de jQuery
        $.ajax({
            //Definimos la URL del archivo al cual vamos a enviar los datos
            url: "../controles/sig.php",
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
            ima.dialog('option', 'title', 'Alta de Imagen Renderizada');
            ima.dialog({width: 300, height: 200});
            ima.text('Se actualizo con exito:' + $("#file").val() + " de " + $("#medicion").val());
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
    $.myFunction = function (file, id) {
        $.ajax({
            type: "POST",
            url: '../vista/a.php',
            data: {'idpersona': id, 'file': file},
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
            $("#mensaje").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ['image/img'];

            if ((file.size / 1024 / 1024) > 50)
            {
                ima.html('Este arhivo es de : ' + this.files[0].size / 1024 / 1024 + "MB pasa los 50 MB");
                ima.dialog("open");
                return false;
//              $('#previewing').attr('src', 'noimage.png');application/vnd.google-earth.kml+xml
//                ima.html("<p>Seleccione una solo tipo de archivo </p><p>"+file+"</p><span id='error_message'>Solo Archivos ima render "+imagefile+"</span>");
//                ima.dialog("open");
//                return false;
            }
//        else
//        {
////                $("#message").html(imagefile );
//        }
        });
    });
});