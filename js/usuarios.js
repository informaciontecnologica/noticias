/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var app = angular.module('myApp', []);
app.controller('cus', function ($scope, $http, $filter) {
    $scope.detalle = false;
    $scope.lista = true;

    $scope.perfiles = [
        {'id': 1, 'label': 'Administracion'},
        {'id': 2, 'label': 'Editor'},
        {'id': 3, 'label': 'Registrador'},
        {'id': 5, 'label': 'Usuario'}
    ];

    $http.get("../controles/listausuario.php")
            .success(function (response) {
                $scope.usuario = response.usuarios;
            });

    $scope.Estado = function (id) {

        $http("../controles/bajapersona.php",
                {'idpersona': id}
        ).success(function (response) {
            $scope.personas = response.personas;
        });
    };
    $scope.update = function (a, idusuario) {

        $http({
            method: "POST",
            url: '../controles/cambioperfil.php',

            data: {idusuario: idusuario, idperfil: a}

        }).then(function (response) {

            console.log(response.data);

        });


    };


    $scope.vistausuario = function (id) {
        $scope.detalle = true;
        $scope.perfil = $filter('filter')($scope.usuario, {'idpersonas': id});
        $scope.persona = $scope.perfil[0].apellido + ' ' + $scope.perfil[0].nombre;
        $scope.mail = $scope.perfil[0].mail;
        $scope.direccion = $scope.perfil[0].direccion;
        $scope.telefono = $scope.perfil[0].telefono;
        $scope.documento = $scope.perfil[0].documento;
        $scope.nacimiento = $scope.perfil[0].nacimiento;

    };
    
    $scope.vista = function (valor) {
        switch (valor) {
            case  'nuevo':
                $scope.nuevo = true;
                $scope.lista = false;
                $scope.detalle = false;
                break;
            case 'lista' :
                $scope.lista = true;
                $scope.nuevo = false;
                $scope.detalle = false;
                break;

        }
    };


});

$(document).ready(function () {


    var mensaje = $('#dialogo').dialog({
        autoOpen: false,
        resizable: true,
        height: 600,
        width: 800,
        modal: false,
        buttons: {
            "Cerrar": function () {
                $(this).dialog("close");
            }
        }
    });


    //Cuando el formulario con ID acceso se envíe...
    $("#usuario").on("submit", function (e) {
        //Evitamos que se envíe por defecto
        e.preventDefault();
        //Creamos un FormData con los datos del mismo formulario
        var formData = new FormData(document.getElementById("usuario"));
        //Llamamos a la función AJAX de jQuery
        $.ajax({
            //Definimos la URL del archivo al cual vamos a enviar los datos
            url: "../controles/AltausuarioAdminist.php",
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
            //Cuando recibamos respuesta, la mostramos
            if (echo === 'Existedocu') {
                mensaje.dialog('option', 'title', 'Información');

                mensaje.dialog({width: 300, height: 200});
                mensaje.html('Documento ya existente<br>');
//                mensaje.on("dialogbeforeclose", function (event, ui) {
//                    location.reload();
//                });
                mensaje.dialog('open');
            };
            if (echo === 'completo') {
                mensaje.dialog('option', 'title', 'Alta Usuario');

                mensaje.dialog({width: 300, height: 200});
                mensaje.html('Se realizo con existo el Alta de <br>'+$('#nombre').val()+ +$('#apellido').val());
                mensaje.on("dialogbeforeclose", function (event, ui) {
                    location.reload();
                });
                mensaje.dialog('open');
            }

        });
    });

    $("#mail").keyup(function () {
        var ma = new FormData(document.getElementById("mail"));
        $.ajax({
            type: "POST",
            url: '../controles/buscarmail.php',
            data:  {mail : $('#mail').val()},

            success: function (data) {
                console.log(data);
                if (data !='ok') {
                    mensaje.dialog('option', 'title', 'Información');
                    mensaje.dialog({width: 300, height: 200});
                    mensaje.html('mail ya existente<br>');
                    mensaje.dialog('open');
                }

            }

        });
    });


});